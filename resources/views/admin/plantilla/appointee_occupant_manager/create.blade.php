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
    <div class="relative w-full max-w-10xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    Plantilla Position Manager
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
                <form action="{{ route('plantilla-position-manager.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="officeid" required readonly value="{{ $office->officeid }}" />
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <fieldset class="border p-4">
                            <legend>Position Details</legend>
                            <div class="mb-3">
                                <label for="pos_suffix">Position Suffix<sup>*</sup></label>
                                <input id="pos_suffix" name="pos_suffix" required />
                                @error('pos_suffix')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ces_equivalent">CES Equivalent<sup>*</sup></label>
                                <select id="ces_equivalent" name="ces_equivalent" required
                                    onchange="posCode(this.value)">
                                    <option disabled selected>Select Position Level</option>
                                    @foreach ($planPositionLibrary as $data)
                                    <option value="{{ $data->poslevel_code }}">
                                        {{ $data->title }}, SG {{ $data->sg }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ces_equivalent')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pos_code">Position Title<sup>*</sup></label>
                                <select id="pos_code" name="pos_code" required onchange="posTitle()">
                                    <option disabled selected>Select Position Title</option>
                                </select>
                                @error('pos_code')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pos_func_name">Functional Title<sup>*</sup></label>
                                <input id="pos_func_name" name="pos_func_name" required readonly />
                                @error('pos_func_name')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_ces_pos" name="is_ces_pos" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_ces_pos">
                                        CES Position
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="pres_apptee" name="pres_apptee" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="pres_apptee">
                                        Pres Appointee
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="use_func_title" name="use_func_title" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="use_func_title">
                                        Use Func Title
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_active" name="is_active" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_active">
                                        Active
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_head" name="is_head" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_head">
                                        Head of Agency
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_generic" name="is_generic" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_generic">
                                        Generic
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_vacant" name="is_vacant" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_vacant">
                                        Vacant
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_occupied" name="is_occupied" type="checkbox" value="1">
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_occupied">
                                        Occupied
                                    </label>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="pos_default">Default Title<sup>*</sup></label>
                                <input id="pos_default" name="pos_default" required />
                                @error('pos_default')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mb-3">
                                    <label for="corp_sg">Grade Level<sup>*</sup></label>
                                    <input id="corp_sg" name="corp_sg" required type="number" />
                                    @error('corp_sg')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="item_no">Item No.<sup>*</sup></label>
                                    <input id="item_no" name="item_no" required />
                                    @error('item_no')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remarks">Remarks<sup>*</sup></label>
                                <textarea name="remarks" id="remarks" cols="50" rows="3"></textarea>
                                @error('remarks')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </fieldset>

                        <fieldset class="border p-4">
                            <legend>Classification Basis</legend>
                            <div class="mb-3">
                                <label for="cbasis_code">Classification Basis</label>
                                <select id="cbasis_code" name="cbasis_code" onchange="classificationBasis(this.value)">
                                    <option disabled selected>Select Classification Basis</option>
                                    @foreach ($classBasis as $data)
                                    <option value="{{ $data->cbasis_code }}">{{ $data->basis }}</option>
                                    @endforeach
                                </select>
                                @error('cbasis_code')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="titleAndDate">Title/Date</label>
                                <textarea name="titleAndDate" id="titleAndDate" cols="50" rows="3" readonly></textarea>
                                @error('titleAndDate')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cbasis_remarks">Notes</label>
                                <textarea name="cbasis_remarks" id="cbasis_remarks" cols="50" rows="3"></textarea>
                                @error('cbasis_remarks')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
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