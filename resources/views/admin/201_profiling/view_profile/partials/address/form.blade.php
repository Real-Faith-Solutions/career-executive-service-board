<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Permanent Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#">

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
                        <label for="region">Region<sup>*</span></label>
                        <select id="regionsSelect">
                            <option value="">Select a region</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="city_or_municipality">City or Municipality<sup>*</span></label>
                        <select id="city_or_municipality" name="city_or_municipality" required>
                            <option disabled selected>Select City of Municipality</option>
                        </select>
                        @error('city_or_municipality')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brgy_or_district">Barangay or District<sup>*</span></label>
                        <select id="brgy_or_district" name="brgy_or_district" required>
                            <option disabled selected>Select Barangay or District</option>
                        </select>
                        @error('brgy_or_district')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
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
                        <label for="floor_bldg">Street/Lot no./Building/Floor no.</label>
                        <input id="floor_bldg" name="floor_bldg" type="text">
                        @error('floor_bldg')
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

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Mailing Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#">

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
                        <label for="region">Region<sup>*</span></label>
                        <select id="region" name="region" required>
                            <option disabled selected>Select Region</option>
                        </select>
                        @error('region')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city_or_municipality">City or Municipality<sup>*</span></label>
                        <select id="city_or_municipality" name="city_or_municipality" required>
                            <option disabled selected>Select City of Municipality</option>
                        </select>
                        @error('city_or_municipality')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brgy_or_district">Barangay or District<sup>*</span></label>
                        <select id="brgy_or_district" name="brgy_or_district" required>
                            <option disabled selected>Select Barangay or District</option>
                        </select>
                        @error('brgy_or_district')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
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
                        <label for="floor_bldg">Street/Lot no./Building/Floor no.</label>
                        <input id="floor_bldg" name="floor_bldg" type="text">
                        @error('floor_bldg')
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

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Temporary Address (Optional)
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#">

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
                        <label for="region">Region<sup>*</span></label>
                        <select id="region" name="region" required>
                            <option disabled selected>Select Region</option>
                        </select>
                        @error('region')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city_or_municipality">City or Municipality<sup>*</span></label>
                        <select id="city_or_municipality" name="city_or_municipality" required>
                            <option disabled selected>Select City of Municipality</option>
                        </select>
                        @error('city_or_municipality')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brgy_or_district">Barangay or District<sup>*</span></label>
                        <select id="brgy_or_district" name="brgy_or_district" required>
                            <option disabled selected>Select Barangay or District</option>
                        </select>
                        @error('brgy_or_district')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
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
                        <label for="floor_bldg">Street/Lot no./Building/Floor no.</label>
                        <input id="floor_bldg" name="floor_bldg" type="text">
                        @error('floor_bldg')
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


