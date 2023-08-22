@extends('layouts.app')
@section('title', 'Field of Specialization')
@section('sub', 'Field of Specialization Recycle Bin')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('field-specialization.index') }}" class="btn btn-primary" >Go Back</a>
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
            @foreach ($profileLibTblExpertiseGenTrashedRecord as $profileLibTblExpertiseGenTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $profileLibTblExpertiseGenTrashedRecords->GenExp_Code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $profileLibTblExpertiseGenTrashedRecords->Title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $profileLibTblExpertiseGenTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('field-specialization.restore', ['ctrlno'=>$profileLibTblExpertiseGenTrashedRecords->GenExp_Code]) }}" method="POST" id="restore_competency_field_specialization_form{{$profileLibTblExpertiseGenTrashedRecords->GenExp_Code}}">
                                @csrf
                                <button title="Edit" type="button" id="restoreCompetencyFieldSpecializationButton{{$profileLibTblExpertiseGenTrashedRecords->GenExp_Code}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('field-specialization.destroy', ['ctrlno'=>$profileLibTblExpertiseGenTrashedRecords->GenExp_Code]) }}" method="POST" id="delete_competency_field_specialization_form{{$profileLibTblExpertiseGenTrashedRecords->GenExp_Code}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteCompetencyFieldSpecializationButton{{$profileLibTblExpertiseGenTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
    {{ $profileLibTblExpertiseGenTrashedRecord->links() }}
</div>

@endsection