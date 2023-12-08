@extends('layouts.app')
@section('title', 'Resource Speaker')
@section('sub', 'Resource Speaker')
@section('content')
@include('admin.competency.view_profile.header')

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <a href="{{ route('competency-data.index') }}" class="btn btn-primary" >Go Back</a>
        </div>

        <div class="flex items-center">
            <a href="{{ route('resource-speaker.recentlyDeleted') }}">
                <lord-icon
                    src="https://cdn.lordicon.com/jmkrnisz.json"
                    trigger="hover"
                    colors="primary:#DC3545"
                    style="width:34px;height:34px">
                </lord-icon>
            </a>
    
            <a href="{{ route('resource-speaker.create') }}" class="btn btn-primary" >Add Resource Speaker</a>
        </div>
    </div>

    <div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Position
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Department
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Office/Company
                    </th>

                    <th scope="col" class="px-6 py-3">
                        No./Building
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Street
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Barangay
                    </th>

                    <th scope="col" class="px-6 py-3">
                        City/Province
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Contact No.
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Email Address
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Expertise
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resourceSpeaker as $resourceSpeakers)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $resourceSpeakers->lastname. " " .$resourceSpeakers->firstname. " " .$resourceSpeakers->mi ?? 'No Record'  }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Position ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Department ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Office ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Bldg ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Street ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Brgy ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->City ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->contactno ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->emailadd ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->expertise ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('resource-speaker.trainingEnagagement', ['ctrlno'=>$resourceSpeakers->speakerID]) }}" method="GET">
                                    @csrf
                                    <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                        <lord-icon
                                            src="https://cdn.lordicon.com/vufjamqa.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>

                                <form action="{{ route('resource-speaker.edit', ['ctrlno'=>$resourceSpeakers->speakerID]) }}" method="GET">
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

                                <form action="{{ route('resource-speaker.destroy', ['ctrlno'=>$resourceSpeakers->speakerID]) }}" method="POST" id="delete_resource_speaker_form{{$resourceSpeakers->speakerID}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteTrainingVenueManagerButton{{$resourceSpeakers->speakerID}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
        {{ $resourceSpeaker->links() }}
    </div>

@endsection