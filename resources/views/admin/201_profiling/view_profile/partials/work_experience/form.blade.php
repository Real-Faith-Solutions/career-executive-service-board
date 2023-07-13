<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Work experience
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('work-experience.store', ['cesno' =>$mainProfile->cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)<sup>*</span></label>
                        <input id="inclusive_date_from" name="inclusive_date_from" type="date" required>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</span></label>
                        <input id="inclusive_date_to" name="inclusive_date_to" type="date" required>
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="position_or_title">Position Title / Designation<sup>*</span></label>
                        <input id="position_or_title" name="position_or_title" type="text" required>
                        @error('position_or_title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department_or_agency">Department / Agency<sup>*</span></label>
                        <input id="department_or_agency" name="department_or_agency" type="text" required>
                        @error('department_or_agency')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="monthly_salary">Monthly Salary<sup>*</span></label>
                        <input id="monthly_salary" name="monthly_salary" type="text" required>
                        @error('monthly_salary')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="salary">Salary / Job / Pay Grade<sup>*</span></label>  
                        <input id="salary" name="salary" type="text" required>
                        @error('salary')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_of_appointment">Status of Appointment<sup>*</span></label>
                        <select id="status_of_appointment"  name="status_of_appointment" required>
                            <option disabled selected>Select Status of Appointment</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Contractual">Contractual</option>
                        </select>
                        @error('status_of_appointment')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="government_service">Government Service<sup>*</span></label>
                        <select id="government_service" name="government_service" required>
                            <option disabled selected>Select Government Service</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        @error('government_service')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</span></label>
                        <input id="remarks" name="remarks" type="text" required>
                        @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
