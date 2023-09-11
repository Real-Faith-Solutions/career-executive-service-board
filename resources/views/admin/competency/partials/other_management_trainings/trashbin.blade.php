@extends('layouts.app')
@section('title', 'Competency Non-Ces Accredited Training Recycle Bin')
@section('sub', 'Competency Non-Ces Accredited Training Recycle Bin')
@section('content')
@include('admin.competency.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('non-ces-training-management.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
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
                    Inclusive Dates
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
            @foreach ($competencyNonCesAccreditedTrainingTrashedRecord as $competencyNonCesAccreditedTrainingTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->training }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->training_category }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->specialization }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->venue }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->from_dt. ' - '.$competencyNonCesAccreditedTrainingTrashedRecords->to_dt }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->no_hours }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainingTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('non-ces-training-management.restore', ['ctrlno'=>$competencyNonCesAccreditedTrainingTrashedRecords->ctrlno]) }}" method="POST" id="restore_non-ces-training-management_form{{$competencyNonCesAccreditedTrainingTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreNonCesTrainingManagementButton{{$competencyNonCesAccreditedTrainingTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('non-ces-training-management.forceDelete', ['ctrlno'=>$competencyNonCesAccreditedTrainingTrashedRecords->ctrlno]) }}" method="POST" id="permanent_non-ces-training-management_form{{$competencyNonCesAccreditedTrainingTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteNonCesTrainingManagementButton{{$competencyNonCesAccreditedTrainingTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

            {{-- non ces training 201 trash bin --}}
                @foreach ($nonCesAccreditedTraining201TrashedRecord as $nonCesAccreditedTraining201TrashedRecords)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $nonCesAccreditedTraining201TrashedRecords->training }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->training_category }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->trainingProfileLibTblExpertiseSpec->Title }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->sponsor }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->venue }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->from_date. ' - '.$nonCesAccreditedTraining201TrashedRecords->to_date }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->no_training_hours }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201TrashedRecords->deleted_at }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('non-ces-training-management.restoreNonCesTraining201', ['ctrlno'=>$nonCesAccreditedTraining201TrashedRecords->ctrlno]) }}" method="POST" id="restore_non_ces_training_management_201_form{{$nonCesAccreditedTraining201TrashedRecords->ctrlno}}">
                                    @csrf
                                    <button type="button" id="restoreNonCesTrainingManagement201Button{{$nonCesAccreditedTraining201TrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>

                                <form action="{{ route('non-ces-training-management.forceDeleteNonCesTraining201', ['ctrlno'=>$nonCesAccreditedTraining201TrashedRecords->ctrlno]) }}" method="POST" id="permanent_non_ces_training_management_201_form{{$nonCesAccreditedTraining201TrashedRecords->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="permanentDeleteNonCesTrainingManagement201Button{{$nonCesAccreditedTraining201TrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
            {{-- end of non ces training 201 trash bin --}}
        </tbody>
    </table>
</div>

@endsection