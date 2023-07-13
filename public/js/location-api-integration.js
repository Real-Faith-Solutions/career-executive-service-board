{/* <script> */}

    // permanent address
    const regionsSelectPermanent = document.getElementById('regionsSelectPermanent');
    const citySelectPermanent = document.getElementById('citySelectPermanent');
    const brgySelectPermanent = document.getElementById('brgySelectPermanent');

    // Fetch Regions data from the API
    fetch('https://psgc.gitlab.io/api/regions/')
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('regionsSelectPermanent');
        const selectedRegion = document.getElementById('regionsSelectPermanent').value;

        // Iterate through the data and create options for the select input
        // if there is an existing address it will make selected the region code of existin address
        data.forEach(region => {
            const option = document.createElement('option');

            if (region.code == selectedRegion) {
                option.selected = true;
            }

            option.value = region.code;
            option.text = region.name;

            selectElement.appendChild(option);
            
        });

    })
    .catch(error => {
        console.error('Error:', error);
    });

    // if there is existing permanent address, the api will fetch with selected city based on existing address
    const selectedCity = document.getElementById('citySelectPermanent').value;
    if (selectedCity != '') {

        const selectedRegion = document.getElementById('regionsSelectPermanent').value;

        // Clear the provinces select input
        citySelectPermanent.innerHTML = '<option value="">Select City or Municipality</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(city => {
                const option = document.createElement('option');

                if (city.code == selectedCity) {
                    option.selected = true;
                }

                option.value = city.code;
                option.text = city.name;
                citySelectPermanent.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    // if there is existing permanent address, the api will fetch with selected brgy based on existing address
    const selectedBrgy = document.getElementById('brgySelectPermanent').value;
    if (selectedBrgy != '') {

        // Clear the Barangay select input
        brgySelectPermanent.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected brgy
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays/`)
        .then(response => response.json())
        .then(data => {
            
            // Populate the Barangay select input
            data.forEach(brgy => {
                const option = document.createElement('option');

                if (brgy.code == selectedBrgy) {
                    option.selected = true;
                }

                option.value = brgy.code;
                option.text = brgy.name;
                brgySelectPermanent.appendChild(option);
            });
            
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    // Event listener for region selection, the selection of city will also change
    regionsSelectPermanent.addEventListener('change', () => {
        const selectedRegion = regionsSelectPermanent.value;

        // Clear the City and brgy select input
        citySelectPermanent.innerHTML = '<option value="">Select City or Municipality</option>';
        brgySelectPermanent.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the City or Municipality select input
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

    // Event listener for city or municipality selection, the brgy selection will also change
    citySelectPermanent.addEventListener('change', () => {
        const selectedCity = citySelectPermanent.value;

        // Clear the Barangay select input
        brgySelectPermanent.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays/`)
        .then(response => response.json())
        .then(data => {
            // Populate the Barangay select input
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
        const selectedRegion = document.getElementById('regionsSelectMailing').value;

        // Iterate through the data and create options for the select input
        // if there is an existing address it will make selected the region code of existin address
        data.forEach(region => {
            const option = document.createElement('option');

            if (region.code == selectedRegion) {
                option.selected = true;
            }

            option.value = region.code;
            option.text = region.name;

            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // if there is existing permanent address, the api will fetch with selected city based on existing address
    const selectedCityMailing = document.getElementById('citySelectMailing').value;
    if (selectedCityMailing != '') {

        const selectedRegion = document.getElementById('regionsSelectMailing').value;

        // Clear the provinces select input
        citySelectMailing.innerHTML = '<option value="">Select City or Municipality</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(city => {
                const option = document.createElement('option');

                if (city.code == selectedCityMailing) {
                    option.selected = true;
                }

                option.value = city.code;
                option.text = city.name;
                citySelectMailing.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    // if there is existing permanent address, the api will fetch with selected brgy based on existing address
    const selectedBrgyMailing = document.getElementById('brgySelectMailing').value;
    if (selectedBrgyMailing != '') {

        // Clear the Barangay select input
        brgySelectMailing.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected brgy
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCityMailing}/barangays/`)
        .then(response => response.json())
        .then(data => {
            
            // Populate the Barangay select input
            data.forEach(brgy => {
                const option = document.createElement('option');

                if (brgy.code == selectedBrgyMailing) {
                    option.selected = true;
                }

                option.value = brgy.code;
                option.text = brgy.name;
                brgySelectMailing.appendChild(option);
            });
            
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    // Event listener for region selection
    regionsSelectMailing.addEventListener('change', () => {
        const selectedRegion = regionsSelectMailing.value;

        // Clear the city and brgy select input
        citySelectMailing.innerHTML = '<option value="">Select City or Municipality</option>';
        brgySelectMailing.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the city select input
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

        // Clear the brgy select input
        brgySelectMailing.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCity}/barangays/`)
        .then(response => response.json())
        .then(data => {
            // Populate the brgy select input
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
        const selectedRegion = document.getElementById('regionsSelectTemporary').value;

        // Iterate through the data and create options for the select input
        data.forEach(region => {
            const option = document.createElement('option');

            if (region.code == selectedRegion) {
                option.selected = true;
            }

            option.value = region.code;
            option.text = region.name;

            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // if there is existing permanent address, the api will fetch with selected city based on existing address
    const selectedCityTemporary = document.getElementById('citySelectTemporary').value;
    if (selectedCityTemporary != '') {

        const selectedRegion = document.getElementById('regionsSelectTemporary').value;

        // Clear the city select input
        citySelectTemporary.innerHTML = '<option value="">Select City or Municipality</option>';

        // Fetch data for the selected region
        fetch(`https://psgc.gitlab.io/api/regions/${selectedRegion}/cities-municipalities/`)
        .then(response => response.json())
        .then(data => {
            // Populate the provinces select input
            data.forEach(city => {
                const option = document.createElement('option');

                if (city.code == selectedCityTemporary) {
                    option.selected = true;
                }

                option.value = city.code;
                option.text = city.name;
                citySelectTemporary.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    // if there is existing permanent address, the api will fetch with selected brgy based on existing address
    const selectedBrgyTemporary = document.getElementById('brgySelectTemporary').value;
    if (selectedBrgyTemporary != '') {

        // Clear the Barangay select input
        brgySelectTemporary.innerHTML = '<option value="">Select Barangay</option>';

        // Fetch data for the selected brgy
        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCityTemporary}/barangays/`)
        .then(response => response.json())
        .then(data => {
            
            // Populate the Barangay select input
            data.forEach(brgy => {
                const option = document.createElement('option');

                if (brgy.code == selectedBrgyTemporary) {
                    option.selected = true;
                }

                option.value = brgy.code;
                option.text = brgy.name;
                brgySelectTemporary.appendChild(option);
            });
            
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    // Event listener for region selection
    regionsSelectTemporary.addEventListener('change', () => {
        const selectedRegion = regionsSelectTemporary.value;

        // Clear the provinces select input
        citySelectTemporary.innerHTML = '<option value="">Select City or Municipality</option>';
        brgySelectTemporary.innerHTML = '<option value="">Select Barangay</option>';

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
        brgySelectTemporary.innerHTML = '<option value="">Select Barangay</option>';

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

{/* </script> */}