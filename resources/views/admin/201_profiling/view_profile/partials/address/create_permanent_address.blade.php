<form action="{{ route('add-address-permanent-201', ['cesno'=>$cesno]) }}" enctype="multipart/form-data" id="address_permanent" onsubmit="return checkErrorsBeforeSubmit(address_permanent)" method="POST">
    @csrf
    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="regionsSelectPermanent">Region<sup>*</span></label>
            <select id="regionsSelectPermanent" name="regionsSelectPermanent" required>
                @if ($region != '')
                    <option value="{{ $region }}" selected></option>
                @else
                    <option disabled selected>Select Region</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="citySelectPermanent">City or Municipality<sup>*</span></label>
            <select id="citySelectPermanent" name="citySelectPermanent" required>
                @if ($city != '')
                    <option value="{{ $city }}" selected></option>
                @else
                    <option disabled selected>Select City or Municipality</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="brgySelectPermanent">Barangay<sup>*</span></label>
            <select id="brgySelectPermanent" name="brgySelectPermanent" required>
                @if ($brgy != '')
                    <option value="{{ $brgy }}" selected></option>
                @else
                    <option disabled selected>Select Barangay</option>
                @endif
            </select>
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="permanent_zip_code">Zip code<sup>*</span></label>
            <input id="permanent_zip_code" name="zip_code" type="text" value="{{ $zip_code }}" oninput="validateInput(permanent_zip_code, 4, 'numbers')" onkeypress="validateInput(permanent_zip_code, 4, 'numbers')" onblur="checkErrorMessage(permanent_zip_code)" required>
            <p class="input_error text-red-600"></p>
            @error('zip_code')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-span-2">
            <label for="street_lot_bldg_floor">Street/Lot no./Building/Floor no.<sup>*</span></label>
            <input id="street_lot_bldg_floor" name="street_lot_bldg_floor" type="text" value="{{ $street_lot_bldg_floor }}" oninput="validateInput(street_lot_bldg_floor, 4)" onkeypress="validateInput(street_lot_bldg_floor, 4)" onblur="checkErrorMessage(street_lot_bldg_floor)" required>
            <p class="input_error text-red-600"></p>
            @error('street_lot_bldg_floor')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

    </div>
    <div class="flex justify-end">
        <button type="button" class="btn btn-primary" id="updatePermanentAddressButton" onclick="openConfirmationDialog(this, 'Confirm Address', 'Are you sure you want to submit/update this info?')">Save Changes</button>
    </div>
</form>