@extends('layouts.app')
@section('title', 'Appointee Occupant Browser - Edit')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-occupant-browser.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Appointee Occupant Browser
            </h1>
        </div>

        <div class="bg-white px-6 py-3">

            <div class="grid grid-row-3 grid-cols-2 gap-4">

                <fieldset class="border p-4 row-span-3">
                    <legend>Office information</legend>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="office">Office</label>
                            <input id="office" value="{{ $datas->planPosition->office->title }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="acronym">Acronym</label>
                            <input id="acronym" value="{{ $datas->planPosition->office->acronym }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="website">Website</label>
                            <input id="website" value="{{ $datas->planPosition->office->website }}" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="emailadd">Email</label>
                            <input id="emailadd" value="{{ $datas->planPosition->office->officeAddress->emailadd }}"
                                readonly />
                        </div>
                        <div class="mb-3">
                            <label for="contactno">Contact number</label>
                            <input id="contactno" value="{{ $datas->planPosition->office->officeAddress->contactno }}"
                                readonly />
                        </div>

                        <div class="mb-3">
                            <label for="city">City</label>
                            <input id="city" value="{{ $datas->planPosition->office->officeAddress->cities->name }}"
                                readonly />
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="30" rows="10" readonly>{{ $address }}</textarea>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="border p-4 row-span-1">
                    <legend>Appointee's Information</legend>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="appointee">
                                {{ $datas->is_appointee == 1 ? 'Appointee' : 'Occupant'}}
                            </label>
                            <input id="appointee" value="{{ $appointee }}" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="personnelMovement">Personnel Movement</label>
                            <input id="personnelMovement" value="{{ $datas->apptStatus->title }}" readonly />
                        </div>

                    </div>
                </fieldset>

                <fieldset class="border p-4 row-span-1">
                    <legend>Position information</legend>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="dbm_title">DBM Position Title</label>
                            <input id="dbm_title" value="{{ $datas->planPosition->positionMasterLibrary->dbm_title}}"
                                readonly />
                        </div>
                        <div class="mb-3">
                            <label for="sg">Salary Grade Level</label>
                            <input id="sg" value="{{ $datas->planPosition->positionMasterLibrary->sg}}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="item_no">DBM Item no.</label>
                            <input id="item_no" value="{{ $datas->planPosition->item_no}}" readonly />
                        </div>


                    </div>
                </fieldset>

                <fieldset class="border p-4 row-span-1">
                    <legend>Classification Information</legend>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="basis">Basis</label>
                            <input id="basis" value="{{ $datas->planPosition->classBasis->basis}}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input id="title" value="{{ $datas->planPosition->classBasis->title}}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="classdate">Date</label>
                            <input id="classdate" value="{{ $datas->planPosition->classBasis->classdate}}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="remarks">Remarks</label>
                            <textarea id="remarks" readonly>{{ $datas->planPosition->remarks}}</textarea>
                        </div>

                    </div>
                </fieldset>

            </div>
        </div>
    </div>
</div>

@endsection