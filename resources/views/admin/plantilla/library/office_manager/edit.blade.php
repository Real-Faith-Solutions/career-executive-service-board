@extends('layouts.app')
@section('title', 'Office Manager - Edit')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex gap-2">
        <a class="btn btn-primary" href="{{ route('office-manager.show', [
        'sectorid' => $datas->agencyLocation->departmentAgency->sectorid,
        'deptid' => $datas->agencyLocation->departmentAgency->deptid,
        'officelocid' => $datas->officelocid,
        'officeid' => $datas->officeid,
    ]) }}" target="_blank">
            Find in Main Screen
        </a>
        <a class="btn btn-primary" href="{{ route('library-office-manager.index') }}">Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Office Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-office-manager.update', $datas->officeid) }}" method="POST"
                enctype="multipart/form-data" id="updateForm" onsubmit="return checkErrorsBeforeSubmit(updateForm)">
                @csrf
                @method('put')
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="officelocid">Agency Location<sup>*</sup></label>
                        <select id="officelocid" name="officelocid" required>
                            @foreach ($agencyLocations as $data)
                            <option value="{{ $data->officelocid }}" {{ $data->officelocid == $datas->officelocid ?
                                'selected' : ''}}>
                                {{ $data->title }}
                            </option>
                            @endforeach
                        </select>

                        @error('officelocid')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title">Office<sup>*</sup></label>
                        <input name="title" id="title" value="{{ $datas->title }}">
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acronym">Office acronym<sup>*</sup></label>
                        <input name="acronym" id="acronym" value="{{ $datas->acronym }}" minlength="2" maxlength="25" required>
                        @error('acronym')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website">Office website</label>
                        <input name="website" id="website" value="{{ $datas->website }}" type="url">
                        @error('website')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contactno">Office Contact No.</label>
                        <input id="contactno" name="contactno" value="{{ $datas->officeAddress->contactno }}"
                            type="tel" />
                        @error('contactno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailadd">Office E-mail Address</label>
                        <input id="emailadd" name="emailadd" value="{{ $datas->officeAddress->emailadd }}"
                            type="email" />
                        @error('emailadd')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                </div>
                <hr>
                <h1 class="font-semibold">Office Address</h1>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">


                    <div class="mb-3">
                        <label for="floor_bldg">Floor / Bldg.<sup>*</sup></label>
                        <input id="floor_bldg" name="floor_bldg" value="{{ $datas->officeAddress->floor_bldg }}" required/>
                        @error('floor_bldg')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="house_no_st">No. / Street<sup>*</sup></label>
                        <input id="house_no_st" name="house_no_st" value="{{ $datas->officeAddress->house_no_st }}" required/>
                        @error('house_no_st')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brgy_dist">Brgy. / District<sup>*</sup></label>
                        <input id="brgy_dist" name="brgy_dist" value="{{ $datas->officeAddress->brgy_dist }}" required/>
                        @error('brgy_dist')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city_code">City Municipality<sup>*</sup></label>
                        <select id="city_code" name="city_code" required>
                            <option disabled selected value="">Select City Municipality</option>
                            @foreach ($cities as $data)
                            <option value="{{ $data->city_code }}" {{ $data->city_code ==
                                $datas->officeAddress->city_code ?
                                'selected' : '' }}>
                                {{ $data->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('city_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="is_active">Office Status<sup>*</sup></label>
                        <select id="is_active" name="is_active" required>
                            <option disabled selected value="">Select status</option>
                            <option value="1" {{ $datas->is_active == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $datas->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between">
                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($datas->lastupd_dt)->format('m/d/Y \a\t g:iA') }}
                    </h1>
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" id="btnEdit" class="btn btn-primary">
                            Edit Record
                        </button>
                        <button type="button" id="btnSubmit" class="btn btn-primary hidden"
                            onclick="openConfirmationDialog(this, 'Confirm changes', 'Are you sure you want to update this record?')">
                            Save Changes
                        </button>
                        <button type="button" id="btnCancelEdit" class="btn btn-secondary hidden">
                            Cancel Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection