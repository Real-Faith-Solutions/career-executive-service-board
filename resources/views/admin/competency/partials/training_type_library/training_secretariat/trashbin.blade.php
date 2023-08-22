@extends('layouts.app')
@section('title', 'Training Secretariat Recycle Bin')
@section('sub', 'Training Secretariat Recycle Bin')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('training-secretariat.index') }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Ctrlno
                </th>

                <th scope="col" class="px-6 py-3">
                    Description
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
            @foreach ($trainingSecretariatTrashedRecord as $trainingSecretariatTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingSecretariatTrashedRecords->ctrlno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSecretariatTrashedRecords->description }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingSecretariatTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('training-secretariat.restore', ['ctrlno'=>$trainingSecretariatTrashedRecords->ctrlno]) }}" method="GET">
                                @csrf
                                <button title="Restore" class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('training-secretariat.destroy', ['ctrlno'=>$trainingSecretariatTrashedRecords->ctrlno]) }}" method="POST" id="delete_training_secretariat_form{{$trainingSecretariatTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button title="Delete Permanently" type="button" id="deleteTrainingSecretariatButton{{$trainingSecretariatTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

<div class="my-5">
    {{ $trainingSecretariatTrashedRecord->links() }}
</div>

@endsection