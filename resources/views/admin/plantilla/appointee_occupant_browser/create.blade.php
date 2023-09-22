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
                                <label for="Department/Agency">Department/Agency</label>
                                <input id="Department/Agency" value="{{ $department->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Location">Location</label>
                                <input id="Location" value="{{ $departmentLocation->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Office">Office</label>
                                <input id="Office" value="{{ $office->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="titles">CES Level</label>
                                <input id="titles" value="{{ $planPosition->positionMasterLibrary->dbm_title }}"
                                    readonly />
                            </div>
                            <div class="mb-3">
                                <label for="sg">Salary Grade Level</label>
                                <input id="sg" value="{{ $planPosition->positionMasterLibrary->sg }}" readonly />
                            </div>
                        </fieldset>

                        <fieldset class="border p-4">
                            <legend>Occupant information</legend>
                            <label for="appt_stat_code">Personnel Movement<sup>*</sup></label>
                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mb-3">
                                    <select id="appt_stat_code" name="appt_stat_code" required>
                                        <option disabled selected>Select Personnel Movement</option>
                                        @foreach ($apptStatus as $data)
                                        <option value="{{ $data->appt_stat_code }}">{{ $data->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 flex">
                                    <div class="flex">
                                        <div class="flex items-center mr-4">
                                            <input id="is_appointee" name="is_appointee" type="radio" value="1">
                                            <label class="ml-2 text-sm font-medium text-gray-900"
                                                for="is_appointee">Appointee</label>
                                        </div>

                                        <div class="flex items-center mr-4">
                                            <input id="is_occupant" name="is_appointee" type="radio" value="1">
                                            <label class="ml-2 text-sm font-medium text-gray-900"
                                                for="is_occupant">Occupant</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="cesno">Name of officials<sup>*</sup></label>
                                <input id="cesno" list="cesnoList" type="search" />
                                <datalist id="cesnoList">
                                    <option value="1">JOSHUA</option>
                                    <option value="2">ALFARO</option>
                                    <option value="3">VILLANUEVA</option>
                                </datalist>
                            </div>

                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mb-3">
                                    <label for="">CES Status<sup>*</sup></label>
                                    <input id="" readonly /> {{-- from 201 file--}}
                                </div>

                                <div class="mb-3">
                                    <label for="">Assumption Date<sup>*</sup></label>
                                    <input id="" type="date" />
                                </div>
                            </div>

                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mb-3">
                                    <label for="">Gender<sup>*</sup></label>
                                    <input id="" readonly /> {{-- from 201 file--}}
                                </div>

                                <div class="mb-3">
                                    <label for="">Appointment Date<sup>*</sup></label>
                                    <input id="" type="date" />
                                </div>
                            </div>

                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mb-3">
                                    <label for="">Basis</label>
                                    <textarea name="" id="" cols="30" rows="10"
                                        readonly>{{ $planPosition->classBasis->basis }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="">Remarks</label>
                                    <textarea name="" id="" cols="30" rows="10" readonly></textarea> {{-- from 201
                                    file--}}
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="">Special Assignment</label>
                                <textarea name="" id="" cols="30" rows="10" readonly></textarea>
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