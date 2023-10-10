@extends('layouts.app')
@section('title', 'Non-Ces Accredited Training')
@section('sub', 'Non-Ces Accredited Training')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('other-training.recentlyDeleted', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('other-training.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add Management Training</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Training Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Category
                </th>

                <th scope="col" class="px-6 py-3">
                    Specialization
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Hours
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($otherTraining as $otherTrainings)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $otherTrainings->training ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->training_category ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->trainingProfileLibTblExpertiseSpec->Title ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->sponsor ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->venue ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->from_dt. ' - '.$otherTrainings->to_dt ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->no_training_hours ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('other-training.edit', ['ctrlno'=>$otherTrainings->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('other-training.destroy', ['ctrlno'=>$otherTrainings->ctrlno]) }}" method="POST" id="delete_other_training_form{{$otherTrainings->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteOtherTrainingButton{{$otherTrainings->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

            {{-- competency non-ces accredited training --}}
            @foreach ($competencyNonCesAccreditedTraining as $competencyNonCesAccreditedTrainings)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $competencyNonCesAccreditedTrainings->training ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainings->training_category ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainings->specialization ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainings->sponsor ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainings->venue ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            \Carbon\Carbon::parse($competencyNonCesAccreditedTrainings->from_dt)->format('m/d/Y'). ' - '.
                            \Carbon\Carbon::parse($competencyNonCesAccreditedTrainings->to_dt)->format('m/d/Y') ?? 'No Record' 
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyNonCesAccreditedTrainings->no_hours ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('other-training.editCompetencyNonCesTraining', ['ctrlno'=>$competencyNonCesAccreditedTrainings->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('other-training.destroyCompetencyNonCesTraining', ['ctrlno'=>$competencyNonCesAccreditedTrainings->ctrlno]) }}" method="POST" id="delete_competency_other_training_form{{$competencyNonCesAccreditedTrainings->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteCompetencyOtherTrainingButton{{$competencyNonCesAccreditedTrainings->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
            {{-- end competency non-ces accredited training --}}
        </tbody>
    </table>
</div>

@endsection