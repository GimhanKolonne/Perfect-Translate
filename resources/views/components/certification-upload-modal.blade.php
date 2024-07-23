<!-- Certification Upload Modal -->
<div id="certificationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Upload Certification</h3>
            <div class="mt-2 px-7 py-3">
                <form action="{{ route('certifications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="certification_name" class="block text-sm font-medium text-gray-700">Certification Name</label>
                        <input type="text" name="certification_name" id="certification_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="certification_file" class="block text-sm font-medium text-gray-700">Certification File</label>
                        <input type="file" name="certification_file" id="certification_file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
