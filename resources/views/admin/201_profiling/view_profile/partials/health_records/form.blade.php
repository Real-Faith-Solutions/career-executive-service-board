<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Health Record
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('health-record.store', ['cesno'=>$mainProfile->cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="blood_type">Blood Type<sup>*</sup></label>
                        <input id="blood_type" name="blood_type" required type="text">
                        @error('blood_type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="identifying_marks">Identifying Marks<sup>*</sup></label>
                        <input id="identifying_marks" name="identifying_marks" required type="text">
                        @error('identifying_marks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="disability_handicap_defects">PWD<sup>*</sup></label>
                        <select id="disability_handicap_defects" name="disability_handicap_defects" required>
                            <option disabled selected>Select an option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        @error('disability_handicap_defects')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="disability_handicap_defects_specify">Please specify<sup>*</sup></label>
                        <input id="disability_handicap_defects_specify" name="disability_handicap_defects_specify" required type="text">
                        @error('disability_handicap_defects_specify')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="medical_condition_illness">Medical Condition/Illness</label>
                        <input id="medical_condition_illness" name="medical_condition_illness" type="text">
                        @error('medical_condition_illness')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date">Date</label>
                        <input id="date" name="date" type="date">
                        @error('date')
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
