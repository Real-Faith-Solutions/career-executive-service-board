@extends('layouts.app')
@section('title', 'Field of Specialization')
@section('sub', 'Field of Specialization')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-between">
    <div class="flex items-center">
        {{-- Go Back Button --}}
        <a href="{{ route('competency-data.index') }}" class="btn btn-primary" >Go Back</a>
    </div>

    <div class="flex items-center">
        {{-- Trash Bin Icon Button --}}
        <a href="{{ route('field-specialization.recentlyDeleted') }}">
            <lord-icon
                src="https://cdn.lordicon.com/jmkrnisz.json"
                trigger="hover"
                colors="primary:#DC3545"
                style="width:34px;height:34px">
          </lord-icon>
        </a>
    
        {{-- Add Specialization --}}
        <a href="{{ route('field-specialization.create') }}" class="btn btn-primary" >Add Specialization</a>
    </div>
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
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profileLibTblExpertiseGen as $profileLibTblExpertiseGens)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $profileLibTblExpertiseGens->GenExp_Code ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $profileLibTblExpertiseGens->Title ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('field-specialization.edit', ['ctrlno'=>$profileLibTblExpertiseGens->GenExp_Code]) }}" method="GET">
                                @csrf
                                <button title="Edit" class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('field-specialization.destroy', ['ctrlno'=>$profileLibTblExpertiseGens->GenExp_Code]) }}" method="POST" id="delete_competency_field_specialization_form{{$profileLibTblExpertiseGens->GenExp_Code}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteCompetencyFieldSpecializationButton{{$profileLibTblExpertiseGens->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
    {{ $profileLibTblExpertiseGen->links() }}
</div>

@endsection