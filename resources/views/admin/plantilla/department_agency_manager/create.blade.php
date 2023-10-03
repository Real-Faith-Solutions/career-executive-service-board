<div id="agencyCreateModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="modal-content bg-white rounded shadow-lg">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="p-4">
                Department Agency
            </h1>
        </div>

        <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>

        <form action="{{ route('library-department-manager.store') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $datas->sectorid }}" name="sectorid" readonly>
            <input type="hidden"
                value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->name_extension }}"
                readonly>

            <div class="grid grid-cols-2 p-10 gap-2">
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