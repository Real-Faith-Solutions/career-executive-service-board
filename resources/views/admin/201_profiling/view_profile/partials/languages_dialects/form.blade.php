<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Language Dialect
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('language.store', ['cesno'=>$cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="language_code">Language Dialect<sup>*</sup></label>
                        <select id="language_code" name="language_code" required>
                            <option disabled selected value="">Select language</option>
                            @foreach($profileLibTblLanguageRef as $profileLibTblLanguageRefs)
                                <option value="{{ $profileLibTblLanguageRefs->code }}">
                                    {{ $profileLibTblLanguageRefs->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('language_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
