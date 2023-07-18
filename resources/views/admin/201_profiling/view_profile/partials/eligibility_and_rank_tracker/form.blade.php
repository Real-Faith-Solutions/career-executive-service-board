<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Eligibility and Rank Tracker
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#" method="#">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="#">CES Status<sup>*</sup></label>
                        <select id="#" name="#" required type="text">
                            <option disabled selected>Select CES Status</option>
                        </select>
                        @error('#')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="#">Acquired Thru<sup>*</sup></label>
                        <select id="#" name="#" required type="text">
                            <option disabled selected>Select Acquired Thru</option>
                        </select>
                        @error('#')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="#">Status Type<sup>*</sup></label>
                        <select id="#" name="#" required type="text">
                            <option disabled selected>Select Status Type</option>
                        </select>
                        @error('#')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="#">Appointing Authority<sup>*</sup></label>
                        <input id="#" name="#" required type="text">
                        @error('#')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="#">Resolution No<sup>*</sup></label>
                        <input id="#" name="#" required type="number">
                        @error('#')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="#">Date Acquired<sup>*</sup></label>
                        <input id="#" name="#" required type="date">
                        @error('#')
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
