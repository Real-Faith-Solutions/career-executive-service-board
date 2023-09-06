@extends('layouts.app')
@section('title', 'CES Training')
@section('sub', 'CES Training')
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
    
    <a href="{{ route('ces-training.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add New CES Training</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Participants ID
                </th>

                <th scope="col" class="px-6 py-3">
                    CESNO
                </th>

                <th scope="col" class="px-6 py-3">
                    Name
                </th>

                <th scope="col" class="px-6 py-3">
                    CES Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Id
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Status
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Training Hours
                </th>

                <th scope="col" class="px-6 py-3">
                    Payment Status
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
            @foreach ($trainings as $training)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $training->pid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->cesno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->cesTrainingPersonalData->lastname.', '.$training->cesTrainingPersonalData->firstname.', '.$training->cesTrainingPersonalData->name_extension.', '.$training->cesTrainingPersonalData->middleinitial }}
                    </td>

                    <td class="px-6 py-3">
                        {{-- {{ $training->specialization }} --}}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->sessionid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->participantTrainingSession->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->no_hours }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->payment }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $training->remarks }}
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

                            <form action="" method="POST" id="delete_training_session_form{{$training->sessionid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deletetrainingessionButton{{$training->sessionid}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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