@extends('layouts.app')
@section('title', 'Training Session')
@section('sub', 'Training Session Recycle Bin')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-between">
    <a href="{{ route('training-session.recentlyDeletedParticipant') }}" class="btn btn-primary" >Participant Trashbin</a>

    <a href="{{ route('training-session.index') }}" class="btn btn-primary" >Go Back</a>
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
                    Deleted At
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainingSessionTrashedRecord as $trainingSessionTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingSessionTrashedRecords->title ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->sessionid ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->category ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->specialization ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            \Carbon\Carbon::parse($trainingSessionTrashedRecords->from_dt)->format('m/d/Y'). ' - '.
                            \Carbon\Carbon::parse($trainingSessionTrashedRecords->to_dt)->format('m/d/Y') ?? 'No Record' 
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->venuePersonalData->name ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->no_hours ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->status ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->barrio ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            $trainingSessionTrashedRecords->resourceSpeakerPersonalData->lastname.', '.
                            $trainingSessionTrashedRecords->resourceSpeakerPersonalData->firstname  ?? 'No Record' 
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->session_director ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->remarks ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSessionTrashedRecords->deleted_at ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('training-session.restore',['ctrlno'=>$trainingSessionTrashedRecords->sessionid]) }}" method="POST" id="restore_training_session_form{{$trainingSessionTrashedRecords->sessionid}}">
                                @csrf
                                <button type="button" id="restoreTrainingSessionButton{{$trainingSessionTrashedRecords->sessionid}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('training-session.forceDelete', ['ctrlno'=>$trainingSessionTrashedRecords->sessionid]) }}" method="POST" id="permanent_training_session_form{{$trainingSessionTrashedRecords->sessionid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentTrainingSessionButton{{$trainingSessionTrashedRecords->sessionid}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

<div class="m-5">
    {{ $trainingSessionTrashedRecord->links() }}
</div>

@endsection