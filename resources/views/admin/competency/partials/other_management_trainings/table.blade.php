@extends('layouts.app')
@section('title', 'Competency Non-Ces Accredited Training')
@section('sub', 'Competency Non-Ces Accredited Training')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('non-ces-training-management.recentlyDeleted', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
        </lord-icon>
    </a>
    
    <a href="{{ route('non-ces-training-management.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add Management Training</a>
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
            @foreach ($nonCesAccreditedTrainingCompetency as $nonCesAccreditedTrainingCompetencies)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $nonCesAccreditedTrainingCompetencies->training ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $nonCesAccreditedTrainingCompetencies->training_category ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $nonCesAccreditedTrainingCompetencies->specialization ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $nonCesAccreditedTrainingCompetencies->sponsor ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $nonCesAccreditedTrainingCompetencies->venue ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            \Carbon\Carbon::parse($nonCesAccreditedTrainingCompetencies->from_dt)->format('m/d/Y'). ' - '.
                            \Carbon\Carbon::parse($nonCesAccreditedTrainingCompetencies->to_dt)->format('m/d/Y') ?? 'No Record'
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $nonCesAccreditedTrainingCompetencies->no_hours ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('non-ces-training-management.edit', ['ctrlno'=>$nonCesAccreditedTrainingCompetencies->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('non-ces-training-management.destroy', ['ctrlno'=>$nonCesAccreditedTrainingCompetencies->ctrlno]) }}" method="POST" id="delete_non_ces_accredited_training_form{{$nonCesAccreditedTrainingCompetencies->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteNonCessAccreditedTrainingButton{{$nonCesAccreditedTrainingCompetencies->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

            {{-- 201 non ces accredited training --}}
                @foreach ($nonCesAccreditedTraining201 as $nonCesAccreditedTraining201s)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $nonCesAccreditedTraining201s->training }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201s->training_category }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201s->trainingProfileLibTblExpertiseSpec->Title ?? 'No Record'}}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201s->sponsor }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201s->venue }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201s->from_dt ?? 'No Record'. ' - '.$nonCesAccreditedTraining201s->to_dt ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $nonCesAccreditedTraining201s->no_training_hours }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('non-ces-training-management.editNonCesTraining201', ['ctrlno'=>$nonCesAccreditedTraining201s->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                                <form action="{{ route('non-ces-training-management.destroyNonCesTraining201', ['ctrlno'=>$nonCesAccreditedTraining201s->ctrlno]) }}" method="POST" id="delete_non_ces_accredited_training_form{{$nonCesAccreditedTraining201s->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteNonCesAccreditedTraining201Button{{$nonCesAccreditedTraining201s->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
            {{-- end of 201 non ces accredited training --}}
        </tbody>
    </table>
</div>

@endsection