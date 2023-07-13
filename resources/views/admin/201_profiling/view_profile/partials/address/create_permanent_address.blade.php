<form action="{{ route('/add-address-permanent-201', ['cesno'=>$mainProfile->cesno]) }}" enctype="multipart/form-data" id="address-permanent" method="POST">
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
</form>