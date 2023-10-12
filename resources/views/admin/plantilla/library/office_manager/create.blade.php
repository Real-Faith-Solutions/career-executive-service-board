@extends('layouts.app')
@section('title', 'Office Manager - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-office-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Office Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-office-manager.store') }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="officelocid">Agency Location<sup>*</sup></label>
                        <select id="officelocid" name="officelocid" required>
                            @foreach ($departmentAgencies as $departmentAgency)
                            <optgroup label="{{ $departmentAgency->title }}">
                                @foreach ($agencyLocations as $agencyLocation)
                                @if($departmentAgency->deptid == $agencyLocation->deptid)
                                <option value="{{ $agencyLocation->officelocid }}">{{ $agencyLocation->title }}</option>
                                @endif
                                @endforeach
                            </optgroup>
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
                        <input name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acronym">Office acronym<sup>*</sup></label>
                        <input name="acronym" id="acronym" value="{{ old('acronym') }}" minlength="2" maxlength="10">
                        @error('acronym')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website">Office website<sup>*</sup></label>
                        <input name="website" id="website" value="{{ old('website') }}" type="url">
                        @error('website')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contactno">Office Contact No.</label>
                        <input id="contactno" name="contactno" value="{{ old('contactno') }}" type="tel" />
                        @error('contactno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailadd">Office E-mail Address</label>
                        <input id="emailadd" name="emailadd" value="{{ old('emailadd') }}" type="email" />
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
                        <label for="floor_bldg">Floor / Bldg.</label>
                        <input id="floor_bldg" name="floor_bldg" value="{{ old('floor_bldg') }}" />
                        @error('floor_bldg')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="house_no_st">No. / Street</label>
                        <input id="house_no_st" name="house_no_st" value="{{ old('house_no_st') }}" />
                        @error('house_no_st')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brgy_dist">Brgy. / District</label>
                        <input id="brgy_dist" name="brgy_dist" value="{{ old('brgy_dist') }}" />
                        @error('brgy_dist')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city_code">City Municipality<sup>*</sup></label>
                        <select id="city_code" name="city_code" required>
                            <option disabled selected>Select City Municipality</option>
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
                </div>

                {{-- <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="isActive">Office Status<sup>*</sup></label>
                        <select id="isActive" name="isActive" required>
                            <option disabled selected>Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('isActive')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection