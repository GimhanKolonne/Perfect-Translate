<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;
use App\Mail\CertificateUploadedNotification;
use App\Models\Translator;
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
        $currentUserId = auth()->id();

        $translators = Translator::with('user')
            ->where('user_id', '!=', $currentUserId)  // Exclude the logged-in user's profile
            ->paginate(12)
            ->through(function ($translator) {
                $translator->type_of_translator = json_decode($translator->type_of_translator, true) ?? [];
                $translator->language_pairs = json_decode($translator->language_pairs, true) ?? [];

                return $translator;
            });

        return view('translators.index', compact('translators'));
    }

    public function displayProfile($id)
    {
        $translator = Translator::findOrFail($id);

        return view('translators.display', compact('translator'));
    }

    public function create()
    {
        return view('translators.create');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            return redirect()->route('translators.index');
        }

        $query = Translator::query()
            ->join('users', 'translators.user_id', '=', 'users.id')
            ->select('translators.*')
            ->where('users.name', 'LIKE', "%$search%")
            ->orWhere('language_pairs', 'LIKE', "%$search%");

        $translators = $query->paginate(12)
            ->through(function ($translator) {
                $translator->type_of_translator = json_decode($translator->type_of_translator, true) ?? [];
                $translator->language_pairs = json_decode($translator->language_pairs, true) ?? [];

                return $translator;
            });

        return view('translators.index', compact('translators'));

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
                'certificates.*' => [
                    'required',
                    'file',
                    'mimes:pdf',
                    'max:5120', // 5MB max file size per file
                    'mimetypes:application/pdf',
                ],
            ], [
                'certificates.*.required' => 'Please select certificate files to upload.',
                'certificates.*.file' => 'The uploaded file is not valid.',
                'certificates.*.mimes' => 'Each certificate must be a PDF file.',
                'certificates.*.max' => 'Each certificate file size must not exceed 5MB.',
                'certificates.*.mimetypes' => 'Each certificate must be a valid PDF document.',
            ]);

            $translator = auth()->user()->translator;

            // Check if a certificate has already been uploaded
            if ($translator->certificate_path) {
                return redirect()->back()->with('error', 'A certificate has already been uploaded. Please contact support to update your certificate.');
            }

            if ($request->hasfile('certificates')) {
                $paths = [];
                foreach ($request->file('certificates') as $file) {
                    $path = $file->store('certificates', 'public');
                    $paths[] = $path;
                }

                // Store paths as a JSON array or another preferred format
                $translator->certificate_path = json_encode($paths);
                $translator->verification_status = 'Pending';
                $translator->save();

                // Send email notification
                Mail::to($translator->user->email)->send(new CertificateUploadedNotification());

                return redirect()->back()->with('success', 'Certificates uploaded successfully. Your profile is now pending verification.');
            }

            return redirect()->back()->with('error', 'Failed to upload certificates. Please try again.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Certificate upload error: '.$e->getMessage());

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
}
