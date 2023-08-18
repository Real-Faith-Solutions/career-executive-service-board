@extends('layouts.app')
@section('title', 'Trash Bin Training Venue Manager')
@section('sub', 'Trash Bin Training Venue Manager')
@section('content')
@include('admin.competency.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('training-venue-manager.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Venue ID
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    St. Road
                </th>

                <th scope="col" class="px-6 py-3">
                    Barangay/Village
                </th>

                <th scope="col" class="px-6 py-3">
                    City Code
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact No.
                </th>

                <th scope="col" class="px-6 py-3">
                    Email
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact Person
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
            @foreach ($trainingVenueManagerTrashRecord as $trainingVenueManagerTrashRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingVenueManagerTrashRecords->venueid }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingVenueManagerTrashRecords->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->no_street }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->brgy }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->trainingVenueManager->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->contactno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->emailadd }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->contactperson }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagerTrashRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('training-venue-manager.restore', ['ctrlno'=>$trainingVenueManagerTrashRecords->venueid]) }}" method="POST" id="restore_training_venue_manager_form{{$trainingVenueManagerTrashRecords->venueid}}">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="button" id="restoreTrainingVenueManagerButton{{$trainingVenueManagerTrashRecords->venueid}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('training-venue-manager.forceDelete', ['ctrlno'=>$trainingVenueManagerTrashRecords->venueid]) }}" method="POST" id="permanent_training_venue_manager_form{{$trainingVenueManagerTrashRecords->venueid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteTrainingVenueManagerButton{{$trainingVenueManagerTrashRecords->venueid}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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