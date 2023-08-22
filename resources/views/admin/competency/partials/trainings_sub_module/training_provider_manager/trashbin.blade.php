@extends('layouts.app')
@section('title', 'Training Provider Manager Trash Bin')
@section('sub', 'Training Provider Manager Trash Bin')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('training-provider-manager.index') }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Provider ID
                </th>

                <th scope="col" class="px-6 py-3">
                    Provider
                </th>

                <th scope="col" class="px-6 py-3">
                    House Building
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
            @foreach ($trainingProviderTrashRecord as $trainingProviderTrashRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingProviderTrashRecords->providerID }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingProviderTrashRecords->provider }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->house_bldg }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->st_road }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->brgy_vill }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->trainingProviderManager->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->contactno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->emailadd }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->contactperson }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingProviderTrashRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('training-provider-manager.restore', ['ctrlno'=>$trainingProviderTrashRecords->providerID]) }}" method="POST" id="restore_training_provider_manager_form{{$trainingProviderTrashRecords->providerID}}">
                                @csrf
                                <button title="Restore" class="mx-1 font-medium text-blue-600 hover:underline" id="restoreTrainingProviderManagerButton{{$trainingProviderTrashRecords->providerID}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('training-provider-manager.forceDelete', ['ctrlno'=>$trainingProviderTrashRecords->providerID]) }}" method="POST" id="permanent_delete_training_provider_manager_form{{$trainingProviderTrashRecords->providerID}}">
                                @csrf
                                @method('DELETE')
                                <button title="Delete Permanently" type="button" id="permanentDeleteTrainingProviderManagerButton{{$trainingProviderTrashRecords->providerID}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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