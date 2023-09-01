@extends('layouts.app')
@section('title', 'Training Session')
@section('sub', 'Training Session')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
        </lord-icon>
    </a>
    
    <a href="{{ route('training-session.create') }}" class="btn btn-primary" >Add New Training</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Session Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Number
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Category
                </th>

                <th scope="col" class="px-6 py-3">
                    Expertise
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Training Hours
                </th>

                <th scope="col" class="px-6 py-3">
                    Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Barrio
                </th>

                <th scope="col" class="px-6 py-3">
                    Resource Speaker
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Director
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainingSession as $trainingSessions)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingSessions->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->sessionid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->category }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->specialization }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->from_dt. ' - '.$trainingSessions->to_dt }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->venuePersonalData->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->no_hours }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->barrio }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->resourceSpeakerPersonalData->lastname.', '.$trainingSessions->resourceSpeakerPersonalData->firstname }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->session_director }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessions->remarks }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="" method="POST" id="delete_non_ces_accredited_training_form{{$trainingSessions->sessionid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteNonCessAccreditedTrainingButton{{$trainingSessions->sessionid}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/jmkrnisz.json"
                                        trigger="hover"
                                        colors="primary:#880808"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection