const regionsSelectMailingCompetency = document.getElementById('regionsSelectMailingCompetency');
const citySelectMailingCompetency = document.getElementById('citySelectMailingCompetency');
const brgySelectMailingCompetency = document.getElementById('brgySelectMailingCompetency');


// Fetch Regions data from the API
fetch('https://psgc.gitlab.io/api/regions/')
.then(response => response.json())
.then(data => {
    const selectElementCompetency = document.getElementById('regionsSelectMailingCompetency');
    const selectedRegionCompetency = document.getElementById('regionsSelectMailingCompetency').value;

    // Iterate through the data and create options for the select input
    // if there is an existing address it will make selected the region code of existin address
    data.forEach(region => {
        const option = document.createElement('option');

        if (region.code == selectedRegionCompetency) {
            option.selected = true;
        }

        option.value = region.code;
        option.text = region.name;

        selectElementCompetency.appendChild(option);
    });
})
.catch(error => {
    console.error('Error:', error);
});

// if there is existing mailing address, the api will fetch with selected city based on existing address
const selectedCityCompetencyMailingCompetency = document.getElementById('citySelectMailingCompetency').value;
if (selectedCityCompetencyMailingCompetency != '') {

    const selectedRegionCompetency = document.getElementById('regionsSelectMailingCompetency').value;

    // Clear the provinces select input
    citySelectMailingCompetency.innerHTML = '<option value="">Select City or Municipality</option>';

    // Fetch data for the selected region
    fetch(`https://psgc.gitlab.io/api/regions/${selectedRegionCompetency}/cities-municipalities/`)
    .then(response => response.json())
    .then(data => {
        // Populate the provinces select input
        data.forEach(city => {
            const option = document.createElement('option');

            if (city.code == selectedCityCompetencyMailingCompetency) {
                option.selected = true;
            }

            option.value = city.code;
            option.text = city.name;
            citySelectMailingCompetency.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

}

// if there is existing mailing address, the api will fetch with selected brgy based on existing address
const selectedBrgyMailingCompetency = document.getElementById('brgySelectMailingCompetency').value;
if (selectedBrgyMailingCompetency != '') {

    // Clear the Barangay select input
    brgySelectMailingCompetency.innerHTML = '<option value="">Select Barangay</option>';

    // Fetch data for the selected brgy
    fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCityCompetencyMailingCompetency}/barangays/`)
    .then(response => response.json())
    .then(data => {
        
        // Populate the Barangay select input
        data.forEach(brgy => {
            const option = document.createElement('option');

            if (brgy.code == selectedBrgyMailingCompetency) {
                option.selected = true;
            }

            option.value = brgy.code;
            option.text = brgy.name;
            brgySelectMailingCompetency.appendChild(option);
        });
        
    })
    .catch(error => {
        console.error('Error:', error);
    });

}

// Event listener for region selection
regionsSelectMailingCompetency.addEventListener('change', () => {
    const selectedRegionCompetency = regionsSelectMailingCompetency.value;

    // Clear the city and brgy select input
    citySelectMailingCompetency.innerHTML = '<option value="">Select City or Municipality</option>';
    brgySelectMailingCompetency.innerHTML = '<option value="">Select Barangay</option>';

    // Fetch data for the selected region
    fetch(`https://psgc.gitlab.io/api/regions/${selectedRegionCompetency}/cities-municipalities/`)
    .then(response => response.json())
    .then(data => {
        // Populate the city select input
        data.forEach(city => {
            const option = document.createElement('option');
            option.value = city.code;
            option.text = city.name;
            citySelectMailingCompetency.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

});

// Event listener for city or municipality selection
citySelectMailingCompetency.addEventListener('change', () => {
    const selectedCityCompetency = citySelectMailingCompetency.value;

    // Clear the brgy select input
    brgySelectMailingCompetency.innerHTML = '<option value="">Select Barangay</option>';

    // Fetch data for the selected region
    fetch(`https://psgc.gitlab.io/api/cities-municipalities/${selectedCityCompetency}/barangays/`)
    .then(response => response.json())
    .then(data => {
        // Populate the brgy select input
        data.forEach(brgy => {
            const option = document.createElement('option');
            option.value = brgy.code;
            option.text = brgy.name;
            brgySelectMailingCompetency.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

});