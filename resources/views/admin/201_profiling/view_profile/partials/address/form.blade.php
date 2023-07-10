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
                        <label for="brgySelectMailing">Barangay or District<sup>*</span></label>
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
                        <label for="brgySelectTemporary">Barangay or District<sup>*</span></label>
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

<script>

    // permanent address
    const regionsSelectPermanent = document.getElementById('regionsSelectPermanent');
    const citySelectPermanent = document.getElementById('citySelectPermanent');
    const brgySelectPermanent = document.getElementById('brgySelectPermanent');


    // Fetch Regions data from the API
    fetch('https://psgc.gitlab.io/api/regions/')
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('regionsSelectPermanent');

        // Iterate through the data and create options for the select input
        data.forEach(region => {
            const option = document.createElement('option');
            option.value = region.code;
            option.text = region.name;
            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Event listener for region selection
    regionsSelectPermanent.addEventListener('change', () => {
        const selectedRegion = regionsSelectPermanent.value;

        // Clear the provinces select input
        citySelectPermanent.innerHTML = '<option value="">Select City or Municipality</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.code;
                option.text = city.name;
                citySelectPermanent.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });

    // Event listener for city or municipality selection
    citySelectPermanent.addEventListener('change', () => {
        const selectedCity = citySelectPermanent.value;

        // Clear the provinces select input
        brgySelectPermanent.innerHTML = '<option value="">Select a Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(brgy => {
                const option = document.createElement('option');
                option.value = brgy.code;
                option.text = brgy.name;
                brgySelectPermanent.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });

    // mailing address
    const regionsSelectMailing = document.getElementById('regionsSelectMailing');
    const citySelectMailing = document.getElementById('citySelectMailing');
    const brgySelectMailing = document.getElementById('brgySelectMailing');


    // Fetch Regions data from the API
    fetch('https://psgc.gitlab.io/api/regions/')
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('regionsSelectMailing');

        // Iterate through the data and create options for the select input
        data.forEach(region => {
            const option = document.createElement('option');
            option.value = region.code;
            option.text = region.name;
            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Event listener for region selection
    regionsSelectMailing.addEventListener('change', () => {
        const selectedRegion = regionsSelectMailing.value;

        // Clear the provinces select input
        citySelectMailing.innerHTML = '<option value="">Select City or Municipality</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.code;
                option.text = city.name;
                citySelectMailing.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });

    // Event listener for city or municipality selection
    citySelectMailing.addEventListener('change', () => {
        const selectedCity = citySelectMailing.value;

        // Clear the provinces select input
        brgySelectMailing.innerHTML = '<option value="">Select a Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(brgy => {
                const option = document.createElement('option');
                option.value = brgy.code;
                option.text = brgy.name;
                brgySelectMailing.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });

    // temporary address
    const regionsSelectTemporary = document.getElementById('regionsSelectTemporary');
    const citySelectTemporary = document.getElementById('citySelectTemporary');
    const brgySelectTemporary = document.getElementById('brgySelectTemporary');


    // Fetch Regions data from the API
    fetch('https://psgc.gitlab.io/api/regions/')
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('regionsSelectTemporary');

        // Iterate through the data and create options for the select input
        data.forEach(region => {
            const option = document.createElement('option');
            option.value = region.code;
            option.text = region.name;
            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Event listener for region selection
    regionsSelectTemporary.addEventListener('change', () => {
        const selectedRegion = regionsSelectTemporary.value;

        // Clear the provinces select input
        citySelectTemporary.innerHTML = '<option value="">Select City or Municipality</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.code;
                option.text = city.name;
                citySelectTemporary.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });

    // Event listener for city or municipality selection
    citySelectTemporary.addEventListener('change', () => {
        const selectedCity = citySelectTemporary.value;

        // Clear the provinces select input
        brgySelectTemporary.innerHTML = '<option value="">Select a Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(brgy => {
                const option = document.createElement('option');
                option.value = brgy.code;
                option.text = brgy.name;
                brgySelectTemporary.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });

</script>
