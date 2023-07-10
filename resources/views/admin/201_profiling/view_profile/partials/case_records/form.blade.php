<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Case Record/s
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="parties">Parties<sup>*</sup></label>
                        <input id="parties" name="parties" required type="text">
                        @error('parties')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="offense">Offense<sup>*</sup></label>
                        <input id="offense" name="offense" required type="text">
                        @error('offense')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date">Nature of Offense<sup>*</sup></label>
                        <select id="date" name="date" required>
                            <option disabled selected>Select Nature of Offense</option>
                        </select>
                        @error('date')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="case_number">Case number<sup>*</sup></label>
                        <input id="case_number" name="case_number" required type="text">
                        @error('case_number')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_filed">Date Filed<sup>*</sup></label>
                        <input id="date_filed" name="date_filed" required type="date">
                        @error('date_filed')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="venue">Venue<sup>*</sup></label>
                        <input id="venue" name="venue" required type="text">
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
                        </select>
                        @error('case_status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_finality">Date of Finality<sup>*</sup></label>
                        <input id="date_finality" name="date_finality" required type="date">
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
                        <input id="decision" name="decision" required type="text">
                        @error('decision')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</sup></label>
                        <input id="remarks" name="remarks" required type="text">
                        @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end">
                    <button class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
