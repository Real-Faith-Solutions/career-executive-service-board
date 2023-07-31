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
