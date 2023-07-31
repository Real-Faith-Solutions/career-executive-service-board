<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Case Record/s
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('case-record.store', ['cesno'=>$mainProfile->cesno]) }}" method="POST" id="case_records_form" onsubmit="return checkErrorsBeforeSubmit(case_records_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="parties">Parties<sup>*</sup></label>
                        <input type="text" id="parties" name="parties" oninput="validateInput(parties, 2, 'alphaNumeric')" onkeypress="validateInput(parties, 2, 'alphaNumeric')" onblur="checkErrorMessage(parties)" required>
                        <p class="input_error text-red-600"></p>
                        @error('parties')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="offense">Offense<sup>*</sup></label>
                        <input type="text" id="offense" name="offense" oninput="validateInput(offense, 2, 'alphaNumeric')" onkeypress="validateInput(offense, 2, 'alphaNumeric')" onblur="checkErrorMessage(offense)" required>
                        <p class="input_error text-red-600"></p>
                        @error('offense')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nature_of_offense">Nature of Offense<sup>*</sup></label>
                        <select id="nature_of_offense" name="nature_of_offense" required>
                            <option disabled selected>Select Nature of Offense</option>
                            <option value="Administrative">Administrative</option>
                            <option value="Criminal Administrative">Criminal Administrative</option>
                            <option value="Criminal">Criminal</option>
                        </select>
                        @error('nature_of_offense')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="case_number">Case number<sup>*</sup></label>
                        <input type="text" id="case_number" name="case_number" oninput="validateInput(case_number, 2)" onkeypress="validateInput(case_number, 2)" onblur="checkErrorMessage(case_number)" required>
                        <p class="input_error text-red-600"></p>
                        @error('case_number')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_filed">Date Filed<sup>*</sup></label>
                        <input type="date" id="date_filed" name="date_filed" oninput="validateDateInput(date_filed)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_filed')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="venue">Venue<sup>*</sup></label>
                        <input type="text" id="venue" name="venue" oninput="validateInput(venue, 2)" onkeypress="validateInput(venue, 2)" onblur="checkErrorMessage(venue)" required>
                        <p class="input_error text-red-600"></p>
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="case_status">Case Status<sup>*</sup></label>
                        <select id="case_status" name="case_status" required>
                            <option disabled selected>Select Case Status</option>
                            <option value="Dismissed">Dismissed</option>
                            <option value="Acquitted">Acquitted</option>
                        </select>
                        @error('case_status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_finality">Date of Finality<sup>*</sup></label>
                        <input type="date" id="date_finality" name="date_finality" oninput="validateDateInput(date_finality)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_finality')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="decision">Decision<sup>*</sup></label>
                        <input type="text" id="decision" name="decision" oninput="validateInput(decision, 2, 'alphaNumeric')" onkeypress="validateInput(decision, 2, 'alphaNumeric')" onblur="checkErrorMessage(decision)" required>
                        <p class="input_error text-red-600"></p>
                        @error('decision')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</sup></label>
                        <input type="text" id="remarks" name="remarks" oninput="validateInput(remarks, 2, 'alphaNumeric')" onkeypress="validateInput(remarks, 2, 'alphaNumeric')" onblur="checkErrorMessage(remarks)" required>
                        <p class="input_error text-red-600"></p>
                        @error('remarks')
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
