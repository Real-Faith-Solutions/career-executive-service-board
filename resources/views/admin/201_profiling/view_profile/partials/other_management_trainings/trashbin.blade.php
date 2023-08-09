@extends('layouts.app')
@section('title', 'Non-Ces Accredited Training Recycle Bin')
@section('sub', 'Non-Ces Accredited Training Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('other-training.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Control No
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Category
                </th>

                <th scope="col" class="px-6 py-3">
                    Expertise/Field of Specialization
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor/Training Provider
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Training Hours
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
            @foreach ($otherTrainingTrashedRecord as $otherTrainingTrashedRecords)
                <tr class="border-b bg-white">
                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->ctrlno }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $otherTrainingTrashedRecords->training }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->training_category }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->trainingProfileLibTblExpertiseSpec->Title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->venue }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->no_training_hours }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainingTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('other-training.restore', ['ctrlno'=>$otherTrainingTrashedRecords->ctrlno]) }}" method="POST" id="restore_other_training_form{{$otherTrainingTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreOtherTrainingButton{{$otherTrainingTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('other-training.forceDelete', ['ctrlno'=>$otherTrainingTrashedRecords->ctrlno]) }}" method="POST" id="permanent_delete_other_training_form{{$otherTrainingTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteOtherTrainingButton{{$otherTrainingTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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