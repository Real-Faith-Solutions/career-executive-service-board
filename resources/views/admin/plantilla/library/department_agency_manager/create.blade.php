@extends('layouts.app')
@section('title', 'Department Agency Manager - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-department-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Department Agency Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-department-manager.store') }}" method="POST">
                @csrf

                <input type="hidden" id="sectorid" name="sectorid" value="1">
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="agencyType">Agency Type</label>
                        <select id="agencyType" name="agency_typeid" required>
                            @foreach ($sectorManagers as $sectorManager)
                            <optgroup label="{{ $sectorManager->title }}"
                                data-sectorid="{{ $sectorManager->sectorid }}">
                                @foreach ($agencyTypes as $agencyType)
                                @if ($sectorManager->sectorid == $agencyType->sectorid)
                                <option value="{{ $sectorManager->sectorid }}">
                                    {{ $agencyType->title }}
                                </option>
                                @endif
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        <script>
                            // Get a reference to the select element
                            const selectElement = document.getElementById('agencyType');
                            const inputSectorid = document.getElementById('sectorid');
                        
                            // Add an event listener to detect when an option is selected
                            selectElement.addEventListener('change', function() {
                                // Get the selected option
                                const selectedOption = selectElement.options[selectElement.selectedIndex];
                        
                                // Find the parent optgroup of the selected option
                                const parentOptgroup = selectedOption.parentElement;
                        
                                // Retrieve the value of the data-sectorid attribute from the optgroup
                                const sectorId = parentOptgroup.getAttribute('data-sectorid');
                        
                                // Log the sectorId or use it as needed
                                console.log('Selected Sector ID:', sectorId);
                                inputSectorid.value = sectorId;
                                
                            });
                        </script>
                        @error('agency_typeid')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mother_deptid">Mother Agency<sup>*</sup></label>
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
                        <label for="title">Agency Name<sup>*</sup></label>
                        <input id="title" name="title" required value="{{ old('title') }}" />
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acronym">Acronym<sup>*</sup></label>
                        <input id="acronym" name="acronym" required minlength="2" maxlength="10"
                            value="{{ old('acronym') }}" />
                        @error('acronym')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website">Website</label>
                        <input id="website" name="website" type="url" value="{{ old('website') }}" />
                        @error('website')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="submitted_by">Submitted by<sup>*</sup></label>
                        <input id="submitted_by" name="submitted_by" required value="{{ old('submitted_by') }}" />
                        @error('submitted_by')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" id="remarks" cols="30" rows="10">{{ old('remarks') }}</textarea>
                        @error('remarks')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection