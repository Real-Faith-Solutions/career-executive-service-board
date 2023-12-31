@extends('layouts.app')
@section('title', 'Training Provider Manager')
@section('sub', 'Training Provider Manager')
@section('content')
@include('admin.competency.view_profile.header')

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            {{-- Go Back Button --}}
            <a href="{{ route('competency-data.index') }}" class="btn btn-primary" >Go Back</a>
        </div>

        <div class="flex items-center">
            {{-- Trash Bin Icon Button --}}
            <form action="{{ route('training-provider-manager.recentlyDeleted') }}" method="GET">
                @csrf
                <button title="Trash Bin" class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/jmkrnisz.json"
                        trigger="hover"
                        colors="primary:#880808"
                        style="width:34px;height:34px">
                    </lord-icon>
                </button>
            </form>
    
            {{-- Add Training Provider Manager Button --}}
            <a href="{{ route('training-provider-manager.create') }}" class="btn btn-primary" >Add Training Provider Manager</a>
        </div>
    </div>

    <div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
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
                        City
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
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trainingProvider as $trainingProviders)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $trainingProviders->provider ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->house_bldg ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->st_road ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->brgy_vill ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->trainingProviderManager->name ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->contactno ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->emailadd ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingProviders->contactperson ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('training-provider-manager.edit', ['ctrlno'=>$trainingProviders->providerID]) }}" method="GET">
                                    @csrf
                                    <button  class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/bxxnzvfm.json"
                                            trigger="hover"
                                            colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                            style="width:30px;height:30px">
                                        </lord-icon>
                                    </button>
                                </form>

                                <form action="{{ route('training-provider-manager.destroy', ['ctrlno'=>$trainingProviders->providerID]) }}" method="POST" id="delete_training_provider_manager_form{{$trainingProviders->providerID}}">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Delete" type="button" id="deleteTrainingProviderManagerButton{{$trainingProviders->providerID}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
        {{ $trainingProvider->links() }}
    </div>

@endsection










{{-- 
    Created By: Manuel, Jon Rolando Desunia

    {{ add your name here if you update this file }}
    Updated by: 
--}}