<form action="{{ route('/add-address-temporary-201', ['cesno'=>$mainProfile->cesno]) }}" enctype="multipart/form-data" id="address-temporary" method="POST">
    @csrf
    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="regionsSelectTemporary">Region<sup>*</span></label>
            <select id="regionsSelectTemporary" name="regionsSelectTemporary" required>
                @if ($regionTemp != '')
                    <option value="{{ $regionTemp }}" selected></option>
                @else
                    <option disabled selected>Select Region</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="citySelectTemporary">City or Municipality<sup>*</span></label>
            <select id="citySelectTemporary" name="citySelectTemporary" required>
                @if ($cityTemp != '')
                    <option value="{{ $cityTemp }}" selected></option>
                @else
                    <option disabled selected>Select City or Municipality</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="brgySelectTemporary">Barangay<sup>*</span></label>
            <select id="brgySelectTemporary" name="brgySelectTemporary" required>
                @if ($brgyTemp != '')
                    <option value="{{ $brgyTemp }}" selected></option>
                @else
                    <option disabled selected>Select Barangay</option>
                @endif
            </select>
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="zip_code_Temp">Zip code<sup>*</span></label>
            <input id="zip_code_Temp" name="zip_code_Temp" type="text" value="{{ $zip_code_Temp }}" oninput="validateInput(zip_code_Temp, 4, 'numbers')" onkeypress="validateInput(zip_code_Temp, 4, 'numbers')" onblur="checkErrorMessage(zip_code_Temp)" required>
            <p class="input_error text-red-600"></p>
            @error('zip_code_Temp')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-span-2">
            <label for="street_lot_bldg_floor_Temp">Street/Lot no./Building/Floor no.</label>
            <input id="street_lot_bldg_floor_Temp" name="street_lot_bldg_floor_Temp" type="text" value="{{ $street_lot_bldg_floor_Temp }}" oninput="validateInput(street_lot_bldg_floor_Temp, 4)" onkeypress="validateInput(street_lot_bldg_floor_Temp, 4)" onblur="checkErrorMessage(street_lot_bldg_floor_Temp)" required>
            <p class="input_error text-red-600"></p>
            @error('street_lot_bldg_floor_Temp')
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