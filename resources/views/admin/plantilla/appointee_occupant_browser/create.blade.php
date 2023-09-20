<script>
    const classificationBasis = (val) => {
        const titleAndDateTextArea = document.querySelector('#titleAndDate');

        @foreach ($classBasis as $data)
        if ("{{ $data->cbasis_code }}" === val) {
            titleAndDateTextArea.value = "{{ $data->title }}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}";
        }
        @endforeach
    }
    const posCode = (val) => {
        // Get the second dropdown element
        const positionTitleDropdown = document.querySelector("#pos_code");
        const posDefaultInput = document.querySelector('#pos_default');

        // Clear existing options in the second dropdown
        positionTitleDropdown.innerHTML = "";
        posDefaultInput.value = "";

        // Add a default "Select Position Title" option
        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Position Title";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        positionTitleDropdown.appendChild(defaultOption);

        // Populate the second dropdown based on the selected value of the first dropdown
        @foreach ($positionMasterLibrary as $data)
            if ("{{ $data->poslevel_code }}" === val) {
                const option = document.createElement("option");
                option.value = "{{ $data->pos_code }}";
                option.text = "{{ $data->dbm_title }} ,SG {{ $data->sg }}";
                positionTitleDropdown.appendChild(option);
            }
        @endforeach
        
    }

    const posTitle = () => {
        const positionTitleDropdown = document.querySelector("#pos_code");
        const posDefaultInput = document.querySelector('#pos_default');

        const selectedOption = positionTitleDropdown.options[positionTitleDropdown.selectedIndex];
        posDefaultInput.value = selectedOption.textContent;
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
            const checkBox = document.getElementById("use_func_title");
            const input = document.getElementById("pos_func_name");
            const posDefaultInput = document.getElementById("pos_default");
            
            checkBox.addEventListener("change", function () {
                if (checkBox.checked) {
                    input.removeAttribute("readonly");

                    posDefaultInput.setAttribute("disabled", "true");
                    // posDefaultInput.value = "";
                } else {
                    input.setAttribute("readonly", "true");
                    input.value = "";
                    posDefaultInput.removeAttribute("disabled");

                }
            });
        });
</script>

<div id="large-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    CES Position - Add Occupant
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                    data-modal-hide="large-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <form action="#" method="POST">
                    @csrf
                    <div class="sm:gid-row-1 mb-3 grid gap-4 md:grid-row-2 lg:grid-row-2">
                        <fieldset class="border p-4">
                            <legend>Office information</legend>
                            <div class="mb-3">
                                <label for="Department/Agency">Department/Agency<sup>*</sup></label>
                                <input id="Department/Agency" value="{{ $department->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Location">Location<sup>*</sup></label>
                                <input id="Location" value="{{ $departmentLocation->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Office">Office<sup>*</sup></label>
                                <input id="Office" value="{{ $office->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Department/Agency">CES Level<sup>*</sup></label>
                                <input id="Department/Agency" value="{{ $office->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Department/Agency">CES Level<sup>*</sup></label>
                                <input id="Department/Agency" value="{{ $office->title }}" readonly />
                            </div>
                        </fieldset>

                        <fieldset class="border p-4">
                            <legend>Occupant information</legend>
                            <div class="mb-3">
                                <label for="appt_stat_code">Personnel Movement<sup>*</sup></label>
                                <select id="appt_stat_code" name="appt_stat_code" required>
                                    <option disabled selected>Select Personnel Movement</option>
                                    @foreach ($apptStatus as $data)
                                    <option value="{{ $data->appt_stat_code }}">{{ $data->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </fieldset>

                    </div>
                    <div class="flex justify-end">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>