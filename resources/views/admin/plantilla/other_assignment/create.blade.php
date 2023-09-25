<div id="large-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    Add Other Assignment
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
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input id="name" name="name" readonly
                                value="{{ $appointees->personalData->lastname }} {{ $appointees->personalData->firstname }} {{ $appointees->personalData->name_extension }} {{ $appointees->personalData->middlename }}" />
                            @error('name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="appt_status_code">Status<sup>*</sup></label>
                            <select id="appt_status_code" name="appt_status_code" required>
                                <option disabled selected>Select Status</option>
                                @foreach ($apptStatus as $data)
                                <option value="{{ $data->appt_stat_code }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
                            @error('appt_status_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position">Position</label>
                            <input id="position" name="position" readonly
                                value="{{ $planPosition->positionMasterLibrary->dbm_title }}" />
                            @error('name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="from_dt">From<sup>*</sup></label>
                            <input id="from_dt" name="from_dt" required type="date" />
                            @error('from_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="office">Office Agency</label>
                            <input id="office" name="office" readonly value="{{ $departmentLocation->title }}" />
                            @error('office')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="to_dt">To<sup>*</sup></label>
                            <input id="to_dt" name="to_dt" required type="date" />
                            @error('to_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="house_bldg">Floor/Bldg</label>
                            <input id="house_bldg" name="house_bldg" />
                            @error('house_bldg')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="st_road">Street</label>
                            <input id="st_road" name="st_road" />
                            @error('st_road')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brgy_vill">Barangay</label>
                            <input id="brgy_vill" name="brgy_vill" />
                            @error('brgy_vill')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city_code">City</label>
                            <select id="city_code" name="city_code">
                                <option disabled selected>Select City</option>
                                @foreach ($cities as $data)
                                <option value="{{ $data->city_code }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('city_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactno">Contact No</label>
                            <input id="contactno" name="contactno" type="tel" />
                            @error('contactno')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email_addr">Email address</label>
                            <input id="email_addr" name="email_addr" type="email" />
                            @error('email_addr')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" id="remarks" cols="30" rows="10"></textarea>
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