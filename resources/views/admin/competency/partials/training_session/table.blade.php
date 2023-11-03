@extends('layouts.app')
@section('title', 'Training Session')
@section('sub', 'Training Session')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-between">
    <div class="grid lg:grid-cols-3">
        @include('components.search')
    </div>

    <div class="flex items-center">
        <a href="{{ route('training-session.recentlyDeleted') }}">
            <lord-icon 
                src="https://cdn.lordicon.com/jmkrnisz.json" 
                trigger="hover" 
                colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>
    
        <a href="{{ route('training-session.create') }}" class="btn btn-primary">Add New Training</a>
    </div>
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
                    {{ $trainingSessions->title ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->sessionid ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->category ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->specialization ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{
                    \Carbon\Carbon::parse($trainingSessions->from_dt)->format('m/d/Y'). ' - '.
                    \Carbon\Carbon::parse($trainingSessions->to_dt)->format('m/d/Y') ?? 'No Record'
                    }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->venuePersonalData->name ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->no_hours ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->status ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->barrio ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->resourceSpeakerPersonalData->lastname ?? 'No Record' }},
                    {{ $trainingSessions->resourceSpeakerPersonalData->firstname ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->session_director ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $trainingSessions->remarks ?? 'No Record' }}
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex">
                        <form
                            action="{{ route('training-session.participantList', ['sessionId'=>$trainingSessions->sessionid]) }}"
                            method="GET">
                            @csrf
                            <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/isugonwi.json" trigger="hover"
                                    colors="primary:#121331" style="width:30px;height:30px">
                                </lord-icon>
                            </button>
                        </form>


                        <form action="{{ route('training-session.edit',['ctrlno'=>$trainingSessions->sessionid]) }}"
                            method="GET">
                            @csrf
                            <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                                    colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                    style="width:30px;height:30px">
                                </lord-icon>
                            </button>
                        </form>

                        <form action="{{ route('training-session.destroy', ['ctrlno'=>$trainingSessions->sessionid]) }}"
                            method="POST" id="delete_training_session_form{{$trainingSessions->sessionid}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="deleteTrainingSessionButton{{$trainingSessions->sessionid}}"
                                onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                    colors="primary:#880808" style="width:24px;height:24px">
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

<div class="m-5">
    {{ $trainingSession->links() }}
</div>

@endsection