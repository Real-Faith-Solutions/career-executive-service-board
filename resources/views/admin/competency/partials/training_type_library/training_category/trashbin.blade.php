@extends('layouts.app')
@section('title', 'Training Category')
@section('sub', 'Training Category Recyle Bin')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('training-category.index') }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>

                <th scope="col" class="px-6 py-3">
                    Delete At
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainingCategoryTrashedRecord as $trainingCategoryTrashedRecords)
                <tr class="border-b bg-white">
                    <td class="px-6 py-3">
                        {{ $trainingCategoryTrashedRecords->description ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingCategoryTrashedRecords->deleted_at ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('training-category.restore', ['ctrlno'=>$trainingCategoryTrashedRecords->ctrlno]) }}" method="POST" id="restore_training_category_form{{$trainingCategoryTrashedRecords->ctrlno}}">
                                @csrf
                                <button title="Restore" type="button" id="restoreTrainingCategoryButton{{$trainingCategoryTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('training-category.forceDelete', ['ctrlno'=>$trainingCategoryTrashedRecords->ctrlno]) }}" method="POST" id="permanent_delete_training_category_form{{$trainingCategoryTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button title="Delete Permently" type="button" id="permanentDeleteTrainingCategoryButton{{$trainingCategoryTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
    {{ $trainingCategoryTrashedRecord->links() }}
</div>

@endsection