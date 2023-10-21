@extends('layouts.app')
@section('title', 'Appointee Occupant Manager - Edit')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div>
        @if($datas->is_appointee == 1)
        <a class="btn btn-primary mx-1"
            href="{{ route('library-other-assignment.index', ['library_occupant_manager' => $datas->appointee_id]) }}">
            Other Assignment
        </a>
        @endif

        <a class="btn btn-primary" href="{{ route('library-occupant-manager.index') }}">Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Appointee Occupant Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-occupant-manager.update', $datas->appointee_id) }}" method="POST">
                @csrf
                @method('PUT')

                <fieldset class="border p-4">
                    <legend>Occupant information</legend>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="office">Office</label>
                            <input id="office" value="{{ $datas->planPosition->office->title }}" readonly />
                        </div>
                    </div>

                    <label for="appt_stat_code">Personnel Movement<sup>*</sup></label>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">


                        <div class="mb-3">
                            <select id="appt_stat_code" name="appt_stat_code" required>
                                <option disabled selected>Select Personnel Movement</option>
                                @foreach ($apptStatus as $data)
                                <option value="{{ $data->appt_stat_code }}" {{ $data->appt_stat_code ==
                                    $datas->appt_stat_code ? 'selected' : '' }}>
                                    {{ $data->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('appt_stat_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 flex">
                            <div class="flex">
                                <div class="flex items-center mr-4">
                                    <input id="is_appointee" name="is_appointee" type="radio" value="1" {{
                                        $datas->is_appointee ?
                                    'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900"
                                        for="is_appointee">Appointee</label>
                                </div>

                                <div class="flex items-center mr-4">
                                    <input id="is_occupant" name="is_appointee" type="radio" value="0" {{
                                        $datas->is_appointee ? ''
                                    : 'checked' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900"
                                        for="is_occupant">Occupant</label>
                                </div>
                            </div>
                            @error('is_appointee')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-1 lg:grid-cols-1">
                        <div class="mb-3">
                            <label for="lastname">Name of Official</label>
                            <input id="lastname"
                                value="{{ $datas->personalData->lastname }} {{ $datas->personalData->firstname }} {{ $datas->personalData->name_extension }} {{ $datas->personalData->middlename }}"
                                readonly />
                        </div>
                    </div>


                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="cesStatus">CES Status</label>
                            <input id="cesStatus" value="{{ $datas->personalData->cesStatus->description ?? '' }}"
                                readonly />
                        </div>

                        <div class="mb-3">
                            <label for="official_code">Appointing Authority</label>
                            <input id="official_code"
                                value="{{ $authority->profileLibTblAppAuthority->description ?? '' }}" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="assum_date">Assumption Date<sup>*</sup></label>
                            <input id="assum_date" name="assum_date" type="date" value="{{ $datas->assum_date }}"
                                required />
                            @error('assum_date')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="appt_date">Appointment Date<sup>*</sup></label>
                            <input id="appt_date" name="appt_date" type="date" value="{{ $datas->appt_date }}"
                                required />
                            @error('appt_date')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <input id="gender" value="{{ $datas->personalData->gender ?? ''}}" readonly />
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="basis">Basis</label>
                            <textarea name="basis" id="basis" cols="30" rows="10"
                                readonly>{{ $datas->basis }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="30" rows="10"
                                readonly>{{ $datas->personalData->remarks ?? ''}}</textarea>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="special_assignment">Special Assignment</label>
                        <textarea name="special_assignment" id="special_assignment" cols="30" rows="10"
                            readonly></textarea>
                    </div> --}}

                </fieldset>


                <div class="flex justify-between">
                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($datas->lastupd_date)->format('m/d/Y \a\t g:iA') }}
                    </h1>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection