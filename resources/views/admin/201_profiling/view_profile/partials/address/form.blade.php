<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Permanent Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('/add-address-permanent-201', ['cesno'=>$mainProfile->cesno]) }}" enctype="multipart/form-data" id="address-permanent" method="POST">

                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                    </div>
                    <div class="mb-3">
                    </div>
                    <div class="mb-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Set as Mailing Address</span>
                        </label>
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="regionsSelectPermanent">Region<sup>*</span></label>
                        <select id="regionsSelectPermanent" name="regionsSelectPermanent" required>
                            <option value="">Select a region</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="citySelectPermanent">City or Municipality<sup>*</span></label>
                        <select id="citySelectPermanent" name="citySelectPermanent" required>
                            <option disabled selected>Select City or Municipality</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brgySelectPermanent">Barangay<sup>*</span></label>
                        <select id="brgySelectPermanent" name="brgySelectPermanent" required>
                            <option disabled selected>Select a Barangay</option>
                        </select>
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="zip_code">Zip code<sup>*</span></label>
                        <input id="zip_code" name="zip_code" readonly required type="number">
                        @error('zip_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="street_lot_bldg_floor">Street/Lot no./Building/Floor no.</label>
                        <input id="street_lot_bldg_floor" name="street_lot_bldg_floor" type="text">
                        @error('street_lot_bldg_floor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="flex justify-end">
                    <button class="btn btn-primary" id="address-permanent-submit" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Mailing Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ url('/add-address-mailing-201') }}" enctype="multipart/form-data" id="address-mailing" method="POST">

                {{-- <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="type">Type<sup>*</sup></label>
                        <select id="type" name="type" required>
                            <option disabled selected>Select type</option>
                            <option value="Permanent address">Permanent address</option>
                            <option value="Temporary address">Temporary address</option>
                            <option value="Mailing address">Mailing address</option>
                        </select>
                        @error('type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="regionsSelectMailing">Region<sup>*</span></label>
                        <select id="regionsSelectMailing" name="regionsSelectMailing" required>
                            <option disabled selected>Select Region</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="citySelectMailing">City or Municipality<sup>*</span></label>
                        <select id="citySelectMailing" name="citySelectMailing" required>
                            <option disabled selected>Select City or Municipality</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brgySelectMailing">Barangay<sup>*</span></label>
                        <select id="brgySelectMailing" name="brgySelectMailing" required>
                            <option disabled selected>Select a Barangay</option>
                        </select>
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="zip_code">Zip code<sup>*</span></label>
                        <input id="zip_code" name="zip_code" readonly required type="number">
                        @error('zip_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="street_lot_bldg_floor">Street/Lot no./Building/Floor no.</label>
                        <input id="street_lot_bldg_floor" name="street_lot_bldg_floor" type="text">
                        @error('street_lot_bldg_floor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="flex justify-end">
                    <button class="btn btn-primary" id="address-mailing-submit" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Temporary Address (Optional)
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ url('/add-address-temporary-201') }}" enctype="multipart/form-data" id="address-temporary" method="POST">

                {{-- <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="type">Type<sup>*</sup></label>
                        <select id="type" name="type" required>
                            <option disabled selected>Select type</option>
                            <option value="Permanent address">Permanent address</option>
                            <option value="Temporary address">Temporary address</option>
                            <option value="Mailing address">Mailing address</option>
                        </select>
                        @error('type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="regionsSelectTemporary">Region<sup>*</span></label>
                        <select id="regionsSelectTemporary" name="regionsSelectTemporary" required>
                            <option disabled selected>Select Region</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="citySelectTemporary">City or Municipality<sup>*</span></label>
                        <select id="citySelectTemporary" name="citySelectTemporary" required>
                            <option disabled selected>Select City or Municipality</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brgySelectTemporary">Barangay<sup>*</span></label>
                        <select id="brgySelectTemporary" name="brgySelectTemporary" required>
                            <option disabled selected>Select a Barangay</option>
                        </select>
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="zip_code">Zip code<sup>*</span></label>
                        <input id="zip_code" name="zip_code" readonly required type="number">
                        @error('zip_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="street_lot_bldg_floor">Street/Lot no./Building/Floor no.</label>
                        <input id="street_lot_bldg_floor" name="street_lot_bldg_floor" type="text">
                        @error('street_lot_bldg_floor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="flex justify-end">
                    <button class="btn btn-primary" id="address-temporary-submit" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


