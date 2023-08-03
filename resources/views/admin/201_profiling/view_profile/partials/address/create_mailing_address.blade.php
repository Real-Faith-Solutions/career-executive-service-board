<form action="{{ route('/add-address-mailing-201', ['cesno'=>$cesno]) }}" enctype="multipart/form-data" id="address-mailing" method="POST">
    @csrf
    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="regionsSelectMailing">Region<sup>*</span></label>
            <select id="regionsSelectMailing" name="regionsSelectMailing" required>
                @if ($regionMailing != '')
                    <option value="{{ $regionMailing }}" selected></option>
                @else
                    <option disabled selected>Select Region</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="citySelectMailing">City or Municipality<sup>*</span></label>
            <select id="citySelectMailing" name="citySelectMailing" required>
                @if ($cityMailing != '')
                    <option value="{{ $cityMailing }}" selected></option>
                @else
                    <option disabled selected>Select City or Municipality</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="brgySelectMailing">Barangay<sup>*</span></label>
            <select id="brgySelectMailing" name="brgySelectMailing" required>
                @if ($brgyMailing != '')
                    <option value="{{ $brgyMailing }}" selected></option>
                @else
                    <option disabled selected>Select Barangay</option>
                @endif
            </select>
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="zip_code_Mailing">Zip code<sup>*</span></label>
            <input id="zip_code_Mailing" name="zip_code_Mailing" type="text" value="{{ $zip_code_Mailing }}" oninput="validateInput(zip_code_Mailing, 4, 'numbers')" onkeypress="validateInput(zip_code_Mailing, 4, 'numbers')" onblur="checkErrorMessage(zip_code_Mailing)" required>
            <p class="input_error text-red-600"></p>
            @error('zip_code_Mailing')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-span-2">
            <label for="street_lot_bldg_floor_Mailing">Street/Lot no./Building/Floor no.</label>
            <input id="street_lot_bldg_floor_Mailing" name="street_lot_bldg_floor_Mailing" type="text" value="{{ $street_lot_bldg_floor_Mailing }}" oninput="validateInput(street_lot_bldg_floor_Mailing, 4)" onkeypress="validateInput(street_lot_bldg_floor_Mailing, 4)" onblur="checkErrorMessage(street_lot_bldg_floor_Mailing)" required>
            <p class="input_error text-red-600"></p>
            @error('street_lot_bldg_floor_Mailing')
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