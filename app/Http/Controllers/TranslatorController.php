<?php

namespace App\Http\Controllers;

use App\Mail\CertificateSubmitted;
use App\Mail\CertificateUploadedNotification;
use App\Models\Translator;
use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class TranslatorController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */


    public function index()
    {
        return view('translators.index', [
            'translators' => Translator::all()
        ]);
    }

    public function create()
    {
        return view('translators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTranslatorRequest $request)
    {
        // Get the validated data
        $validated = $request->validated();


        $validated['slug'] = \Str::slug($validated['bio']);

        // Serialize arrays
        $validated['type_of_translator'] = json_encode($validated['type_of_translator']);
        $validated['language_pairs'] = json_encode($validated['language_pairs']);

        // Create the translator
        Translator::create($validated);

        $user = auth()->user();
        $user->update(['role' => 'translator']);

        $translator = auth()->user()->translator;

        return redirect()->route('home')
            ->with('flash.banner', 'Profile created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Translator $translator)
    {
        return view('translators.show', compact('translator'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Translator $translator)
    {
        // Decode JSON strings to arrays
        $translator->type_of_translator = json_decode($translator->type_of_translator, true) ?? [];
        $translator->language_pairs = json_decode($translator->language_pairs, true) ?? [];

        return view('translators.edit', compact('translator'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTranslatorRequest $request, Translator $translator)
    {
        $validated = $request->validated();

        $validated['slug'] = \Str::slug($validated['bio']);

        // Ensure these are arrays before encoding
        $validated['type_of_translator'] = json_encode($validated['type_of_translator'] ?? []);
        $validated['language_pairs'] = json_encode($validated['language_pairs'] ?? []);

        $translator->update($validated);

        return redirect()->route('translators.show', $translator)
            ->with('flash.banner', 'Profile updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translator $translator)
    {
        //
    }
    public function uploadCertificate(Request $request)
    {
        try {
            $request->validate([
                'certificate' => [
                    'required',
                    'file',
                    'mimes:pdf',
                    'max:5120', // 5MB max file size
                    'mimetypes:application/pdf',
                ],
            ], [
                'certificate.required' => 'Please select a certificate file to upload.',
                'certificate.file' => 'The uploaded file is not valid.',
                'certificate.mimes' => 'The certificate must be a PDF file.',
                'certificate.max' => 'The certificate file size must not exceed 5MB.',
                'certificate.mimetypes' => 'The certificate must be a valid PDF document.',
            ]);

            $translator = auth()->user()->translator;

            // Check if a certificate has already been uploaded
            if ($translator->certificate_path) {
                return redirect()->back()->with('error', 'A certificate has already been uploaded. Please contact support to update your certificate.');
            }

            if ($request->file('certificate')) {
                $path = $request->file('certificate')->store('certificates', 'public');
                $translator->certificate_path = $path;
                $translator->verification_status = 'Pending';
                $translator->save();

                // Send email notification
                Mail::to($translator->user->email)->send(new CertificateUploadedNotification());

                return redirect()->back()->with('success', 'Certificate uploaded successfully. Your profile is now pending verification.');
            }

            return redirect()->back()->with('error', 'Failed to upload certificate. Please try again.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Certificate upload error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
