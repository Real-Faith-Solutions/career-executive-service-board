@extends('layouts.app')
@section('title', 'Other Assignment - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary"
        href="{{ route('library-other-assignment.index', ['library_occupant_manager' => $appointee->appointee_id]) }}">
        Go back
    </a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Other Assignment
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-other-assignment.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-2">
                    <input type="hidden" name="cesno" value="{{ $appointee->cesno }}">

                    <fieldset class="border p-4">
                        <legend>Office Information</legend>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mb-3">
                                <label for="office">Office Agency</label>
                                <input id="office" name="office" readonly
                                    value="{{ $appointee->planPosition->office->title }}" />
                                @error('office')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="house_bldg">Floor/Bldg</label>
                                <input id="house_bldg" name="house_bldg"
                                    value="{{ $appointee->planPosition->office->officeAddress->floor_bldg }}" />
                                @error('house_bldg')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="st_road">Street</label>
                                <input id="st_road" name="st_road"
                                    value="{{ $appointee->planPosition->office->officeAddress->house_no_st }}" />
                                @error('st_road')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brgy_vill">Barangay</label>
                                <input id="brgy_vill" name="brgy_vill"
                                    value="{{ $appointee->planPosition->office->officeAddress->brgy_dist }}" />
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
                                    <option value="{{ $data->city_code }}" {{ $data->city_code ==
                                        $appointee->planPosition->office->officeAddress->city_code ?
                                        'selected' : ''}}>
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
                            <div class="mb-3">
                                <label for="contactno">Contact No</label>
                                <input id="contactno" name="contactno" type="tel"
                                    value="{{ $appointee->planPosition->office->officeAddress->contactno }}" />
                                @error('contactno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email_addr">Email address</label>
                                <input id="email_addr" name="email_addr" type="email"
                                    value="{{ $appointee->planPosition->office->officeAddress->emailadd }}" />
                                @error('email_addr')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="border p-4">
                        <legend>Special Assignment</legend>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input id="name" name="name" readonly
                                    value="{{ $appointee->personalData->lastname }} {{ $appointee->personalData->firstname }} {{ $appointee->personalData->name_extension }} {{ $appointee->personalData->middlename }}" />
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
                                    value="{{ $appointee->planPosition->positionMasterLibrary->dbm_title }}" />
                                @error('name')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-2">
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
                                    <label for="to_dt">To<sup>*</sup></label>
                                    <input id="to_dt" name="to_dt" required type="date" />
                                    @error('to_dt')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>
                            </div>
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
                    </fieldset>




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

@endsection