@extends('layouts.app')
@section('title', 'General Reports')
@section('sub', 'General Reports')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">201 PROFILE - STATISTICAL REPORTS</span>
        </a>

        <div class="flex justify-end">
            <a href="#" target='_blank' class="btn btn-primary">Generate PDF Report</a>
        </div>
    </div>
</nav>

    <section>

        <form action="{{ route('general-reports.index') }}" class="flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex">
        
                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_active" type="checkbox" name="filter_active" {{ $filter_active == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_active" class="ml-2 mt-2 text-sm font-medium text-gray-700">Active</label>
                </div>
        
                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_inactive" type="checkbox" name="filter_inactive" {{ $filter_inactive == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_inactive" class="ml-2 mt-2 text-sm font-medium text-gray-700">Inactive</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_retired" type="checkbox" name="filter_retired" {{ $filter_retired == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_retired" class="ml-2 mt-2 text-sm font-medium text-gray-700">Retired</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_deceased" type="checkbox" name="filter_deceased" {{ $filter_deceased == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_deceased" class="ml-2 mt-2 text-sm font-medium text-gray-700">Deceased</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="with_pending_case" type="checkbox" name="with_pending_case" {{ $with_pending_case == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="with_pending_case" class="ml-2 mt-2 text-sm font-medium text-gray-700">With Pending Case</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="without_pending_case" type="checkbox" name="without_pending_case" {{ $without_pending_case == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="without_pending_case" class="ml-2 mt-2 text-sm font-medium text-gray-700">Without Pending Case</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_retirement" type="checkbox" name="filter_retirement" {{ $filter_retirement == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_retirement" class="ml-2 mt-2 text-sm font-medium text-gray-700">Candidate For Retirement</label>
                </div>
            </div>

            <div class="flex">

                <div class="flex items-center px-6 py-3 text-left">
                    <label for="cesstat_code" class="mr-2 mt-2 text-sm font-medium text-gray-700">CES Status<sup>*</sup></label>
                    <select id="cesstat_code" name="cesstat_code" required type="text" class="inline-block">
                        <option disabled selected>Select CES Status</option>
                        @foreach ($profileLibTblCesStatus as $newProfileLibTblCesStatus)
                            <option value="{{ $newProfileLibTblCesStatus->code }}" {{ $newProfileLibTblCesStatus->code == $cesstat_code ? 'selected' : '' }}>{{ $newProfileLibTblCesStatus->description }}</option>
                        @endforeach
                        <option value="all" {{ "all" == $cesstat_code ? 'selected' : '' }}>All</option>
                        <option value="cesos" {{ "cesos" == $cesstat_code ? 'selected' : '' }}>CESOs</option>
                        <option value="cesoseli" {{ "cesoseli" == $cesstat_code ? 'selected' : '' }}>CESOs & Eligibles</option>
                    </select>
                    @error('cesstat_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <label for="authority_code" class="mt-2 text-sm font-medium text-gray-700">Appointing Authority<sup>*</sup></label>
                    <select id="authority_code" name="authority_code" required type="text" class="inline-block">
                        <option disabled selected>Select Appointing Authority</option>
                        @foreach ($profileLibTblAppAuthority as $newProfileLibTblAppAuthority)
                            <option value="{{ $newProfileLibTblAppAuthority->code }}" {{ $newProfileLibTblAppAuthority->code == $authority_code ? 'selected' : '' }}>{{ $newProfileLibTblAppAuthority->description }}</option>
                        @endforeach
                        <option value="all" {{ "all" == $authority_code ? 'selected' : '' }}>All</option>
                    </select>
                    @error('authority_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="my-5 mr-2 flex justify-end">
                    <button class="btn btn-primary" type="submit">Apply Filter</button>
                </div>

                <div class="my-5 flex justify-end">
                    <a class="btn btn-primary" href="{{ route('general-reports.index') }}">Remove Filters</a>
                </div>
            </div>

        </form>

        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            sample1
                        </th>
                        <th scope="col" class="px-6 py-3">
                            sample2
                        </th>

                        
                    </tr>
                </thead>
                <tbody>
                        
                </tbody>
            </table>
        </div>

    </section>

@endsection
