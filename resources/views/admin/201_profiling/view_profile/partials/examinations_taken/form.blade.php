<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Examination Attainment
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('examination-taken.store', ['cesno' =>$mainProfile->cesno]) }}" method="POST">
                @csrf
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="type">Type of Examination<sup>*</sup></label>
                        <select id="type" name="type" required>
                            <option disabled selected>Select Type of Examination</option>
                            @foreach ($profileLibTblExamRef as $profileLibTblExamRefs)
                                <option value="{{ $profileLibTblExamRefs }}">{{ $profileLibTblExamRefs }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="rating">Rating (if applicable)</label>
                        <input id="rating" name="rating" type="text">
                        @error('rating')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_of_examination">Date of Examination<sup>*</span></label>
                        <input id="date_of_examination" name="date_of_examination" required type="month">
                        @error('date_of_examination')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="place_of_examination">Place of Examination<sup>*</span></label>
                        <input id="place_of_examination" name="place_of_examination" required type="text">
                        @error('place_of_examination')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="license_number">License details (if applicable)</label>
                        <input id="license_number" name="license_number" type="text">
                        @error('license_number')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_acquired">Date Acquired</label>
                        <input id="date_acquired" name="date_acquired" type="date">
                        @error('date_acquired')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_validity">Date Validity</label>
                        <input id="date_validity" name="date_validity" type="date">
                        @error('date_validity')
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
