@if(!is_null($addressProfilePermanent))
    @php
        
        $region = $addressProfilePermanent->region_code;
        $city = $addressProfilePermanent->city_or_municipality_code;
        $brgy = $addressProfilePermanent->brgy_code;
        $zip_code = $addressProfilePermanent->zip_code;
        $street_lot_bldg_floor = $addressProfilePermanent->street_lot_bldg_floor;
    
    @endphp
@else
    @php 

        $region = '';
        $city = '';
        $brgy = '';
        $zip_code = '';
        $street_lot_bldg_floor = '';

    @endphp
@endif

@if(!is_null($addressProfileMailing))
    @php
        
        $regionMailing = $addressProfileMailing->region_code;
        $cityMailing = $addressProfileMailing->city_or_municipality_code;
        $brgyMailing = $addressProfileMailing->brgy_code;
        $zip_code_Mailing = $addressProfileMailing->zip_code;
        $street_lot_bldg_floor_Mailing = $addressProfileMailing->street_lot_bldg_floor;
    
    @endphp
@else
    @php 

        $regionMailing = '';
        $cityMailing = '';
        $brgyMailing = '';
        $zip_code_Mailing = '';
        $street_lot_bldg_floor_Mailing = '';

    @endphp
@endif

@if(!is_null($addressProfileTemp))
    @php
        
        $regionTemp = $addressProfileTemp->region_code;
        $cityTemp = $addressProfileTemp->city_or_municipality_code;
        $brgyTemp = $addressProfileTemp->brgy_code;
        $zip_code_Temp = $addressProfileTemp->zip_code;
        $street_lot_bldg_floor_Temp = $addressProfileTemp->street_lot_bldg_floor;
    
    @endphp
@else
    @php 

        $regionTemp = '';
        $cityTemp = '';
        $brgyTemp = '';
        $zip_code_Temp = '';
        $street_lot_bldg_floor_Temp = '';

    @endphp
@endif

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 id="address-form-title" class="px-6 py-3">
                Permanent Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">

            {{-- <form action="{{ route('/add-address-permanent-201', ['cesno'=>$mainProfile->cesno]) }}" enctype="multipart/form-data" id="address-permanent" method="POST">
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
                            <option value="{{ $region }}" selected></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="citySelectPermanent">City or Municipality<sup>*</span></label>
                        <select id="citySelectPermanent" name="citySelectPermanent" required>
                            <option value="{{ $city }}" selected></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brgySelectPermanent">Barangay<sup>*</span></label>
                        <select id="brgySelectPermanent" name="brgySelectPermanent" required>
                            <option value="{{ $brgy }}" selected></option>
                        </select>
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="zip_code">Zip code<sup>*</span></label>
                        <input id="zip_code" name="zip_code" type="number" value="{{ $zip_code }}" required>
                        @error('zip_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-span-2">
                        <label for="street_lot_bldg_floor">Street/Lot no./Building/Floor no.</label>
                        <input id="street_lot_bldg_floor" name="street_lot_bldg_floor" type="text" value="{{ $street_lot_bldg_floor }}" required>
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
            </form> --}}

            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="mb-3">
                    <label for="type">Type<sup>*</span></label>
                    <select id="type" name="type" required onchange="toggleAddressType(this.value)">
                        {{-- <option disabled selected>Select Type of Address</option> --}}
                        <option value="Permanent" selected>Permanent</option>
                        <option value="Mailing">Mailing</option>
                        <option value="Temporary">Temporary</option>
                    </select>
                </div>
                {{-- <div class="mb-3">
                </div>
                <div class="mb-3 mt-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900">Set as Mailing Address</span>
                    </label>
                </div> --}}
            </div>

            <div class="Permanent">
                @include('admin.201_profiling.view_profile.partials.address.create_permanent_address')
            </div>
            <div class="Mailing hidden">
                @include('admin.201_profiling.view_profile.partials.address.create_mailing_address')
            </div>
            <div class="Temporary hidden">
                @include('admin.201_profiling.view_profile.partials.address.create_temporary_address')
            </div>

        </div>
    </div>
</div>

{{-- <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Mailing Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ url('/add-address-mailing-201') }}" enctype="multipart/form-data" id="address-mailing" method="POST">
                @csrf
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
                @csrf
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
</div> --}}


