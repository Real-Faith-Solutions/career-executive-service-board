<div id="large-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    Department Agency
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
                <form action="{{ route('library-department-manager.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $datas->sectorid }}" name="sectorid" readonly>
                    <input type="hidden"
                        value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->name_extension }}"
                        readonly>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="mb-3">
                            <label for="mother_deptid">Agency Name<sup>*</sup></label>
                            <select id="mother_deptid" name="mother_deptid" required>
                                @foreach ($motherDepartment as $data)
                                <option value="{{ $data->deptid }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
                            @error('mother_deptid')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="agencyType">Agency Type</label>
                            <select id="agencyType" name="agency_typeid" required>
                                @foreach ($agencyType as $data)
                                <option value="{{ $data->agency_typeid }}">{{ $data->title }}</option>
                                @endforeach
                            </select>
                            @error('agency_typeid')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title">Agency Name</label>
                            <input id="title" name="title" required />
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="acronym">Acronym</label>
                            <input id="acronym" name="acronym" required minlength="2" maxlength="10" />
                            @error('acronym')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website">Website</label>
                            <input id="website" name="website" type="url" />
                            @error('website')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="submitted_by">Submitted by</label>
                            <input id="submitted_by" name="submitted_by" required />
                            @error('submitted_by')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="30" rows="10"></textarea>
                            @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="flex justify-end items-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>