<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Scholarships
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('scholarship.store', ['cesno' => $mainProfile->cesno]) }}" method="POST" id="scholarship_form" onsubmit="return checkErrorsBeforeSubmit(scholarship_form)">
                @csrf
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="type">Scholarship Type<sup>*</sup></label>
                        <select id="type" name="type" required>
                            <option disabled selected>Select Type of Scholarship</option>
                            <option value="Local">Local</option>
                            <option value="Foreign">Foreign</option>
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
                        <label for="title">Title<sup>*</sup></label>
                        <input type="text" id="scholarship_title" name="title" oninput="validateInput(scholarship_title, 2)" onkeypress="validateInput(scholarship_title, 2)" onblur="checkErrorMessage(title)" required>
                        <p class="input_error text-red-600"></p>
                        @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sponsor">Sponsor<sup>*</sup></span></label>
                        <input type="text" id="sponsor" name="sponsor" oninput="validateInput(sponsor, 2)" onkeypress="validateInput(sponsor, 2)" onblur="checkErrorMessage(sponsor)" required>
                        <p class="input_error text-red-600"></p>
                        @error('sponsor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)</label>
                        <input type="date" id="inclusive_date_from" name="inclusive_date_from" oninput="validateDateInput(inclusive_date_from)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)</label>
                        <input type="date" id="inclusive_date_to" name="inclusive_date_to" oninput="validateDateInput(inclusive_date_to)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_to')
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
