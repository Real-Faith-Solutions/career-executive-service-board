@extends('layouts.app')
@section('title', 'Agency Location Manager - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-agency-location-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Agency Location Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-agency-location-manager.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-2">
                    <div class="mb-3">
                        <label for="deptid">Department Agency<sup>*</sup></label>
                        <select id="deptid" name="deptid" required>
                            @foreach ($sectors as $sector)
                            <optgroup label="{{ $sector->title }}" data-sectorid="{{ $sector->sectorid }}">
                                @foreach ($departmentAgencies as $departmentAgency)
                                @if($departmentAgency->sectorid == $sector->sectorid)
                                <option value="{{ $departmentAgency->deptid }}">
                                    {{ $departmentAgency->title }}
                                </option>
                                @endif
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        @error('deptid')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title">Location<sup>*</sup></label>
                        <input id="title" name="title" required />
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acronym">Acronym<sup>*</sup></label>
                        <input id="acronym" name="acronym" minlength="2" maxlength="25" required />
                        @error('acronym')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="loctype_id">Agency Type<sup>*</sup></label>
                        <select id="loctype_id" name="loctype_id" required>
                            @foreach ($agencyLocationLibrary as $data)
                            <option value="{{ $data->agencyloc_Id }}">{{ $data->title }}</option>
                            @endforeach
                        </select>
                        @error('loctype_id')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telno">Telno</label>
                        <input id="telno" name="telno" type="tel" />
                        @error('telno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailaddr">Email</label>
                        <input id="emailaddr" name="emailaddr" type="email" />
                        @error('emailaddr')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="region">Region<sup>*</sup></label>
                        <select id="region" name="region" type="region" required>
                            <option disabled selected value="">Select Region</option>
                            @foreach ($region as $data)
                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('region')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
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

@endsection