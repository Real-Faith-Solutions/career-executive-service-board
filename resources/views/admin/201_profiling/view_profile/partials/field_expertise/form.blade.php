<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Field Expertise
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('expertise.store', ['cesno'=>$mainProfile->cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="expertise_specialization">Expertise / Field of Specialization<sup>*</span></label>
                        {{-- <input id="expertise_specialization" name="expertise_specialization" type="text" required> --}}
                        <select id="expertise_specialization" name="expertise_specialization" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach($profileLibTblExpertiseSpec as $profileLibTblExpertiseSpecs)
                                <option value="{{ $profileLibTblExpertiseSpecs->Title }}">
                                    {{ $profileLibTblExpertiseSpecs->Title }}
                                </option>
                            @endforeach
                        </select>
                        @error('expertise_specialization')
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
