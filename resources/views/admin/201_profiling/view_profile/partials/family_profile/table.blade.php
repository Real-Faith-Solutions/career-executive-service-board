@extends('layouts.app')
@section('title', 'Family Profile')
@section('sub', 'Family Profile')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="my-5 flex justify-end">
    <a href="{{ route('family-profile.recently-deleted', ['cesno'=>$cesno]) }}" method="GET">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>
    <button class="btn btn-primary" onclick="openFormFamilyProfile()">Add Family Profile</button>
    <button class="btn btn-primary hidden" onclick="openTableFamilyProfile()">Go back</button>
</div>

<div class="form-family-profile hidden">
    @include('admin.201_profiling.view_profile.partials.family_profile.form')
</div>


<div class="table-family-profile relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Relationship
                </th>
                <th scope="col" class="px-6 py-3">
                    Lastname
                </th>
                <th scope="col" class="px-6 py-3">
                    Firstname
                </th>
                <th scope="col" class="px-6 py-3">
                    Extension name
                </th>
                <th scope="col" class="px-6 py-3">
                    Middlename
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>

        <tbody>

             {{-- spouse --}}
             @foreach ($SpouseRecords as $newSpouseRecords)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Spouse
                    </td>
                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->first_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->middle_name }}`
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('family-profile.editSpouse', ['ctrlno'=>$newSpouseRecords->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('family-profile-spouse.delete', ['ctrlno'=>$newSpouseRecords->ctrlno]) }}" method="POST" id="delete_spouse_form{{$newSpouseRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteSpouseButton{{$newSpouseRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

            {{-- father details --}}
            @foreach ($father as $newFather)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Father
                    </td>

                    <td class="px-6 py-3">
                        {{ $newFather->father_last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newFather->father_first_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newFather->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newFather->father_middle_name }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('family-profile-father.editFather', ['ctrlno'=>$newFather->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('family-profile-father.destroy', ['ctrlno'=>$newFather->ctrlno]) }}" method="POST" id="delete_father_form{{$newFather->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteFatherButton{{$newFather->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

            {{-- mother details --}}
            @foreach ($mother as $newMother)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Mother
                    </td>

                    <td class="px-6 py-3">
                        {{ $newMother->mother_last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newMother->mother_first_name }}
                    </td>

                    <td class="px-6 py-3">

                    </td>

                    <td class="px-6 py-3">
                        {{ $newMother->mother_middle_name }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('family-profile-mother.editMother', ['ctrlno'=>$newMother->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('family-profile-mother.destroy', ['ctrlno'=>$newMother->ctrlno]) }}" method="POST" id="delete_mother_form{{$newMother->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteMotherButton{{$newMother->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

            {{-- children records --}}
            @foreach ($childrenRecords as $newChildrenRecords)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Children
                    </td>
                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->lname }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->fname }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->mname }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('family-profile.editChildren', ['ctrlno'=>$newChildrenRecords->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('family-profile-children.delete', ['ctrlno'=>$newChildrenRecords->ctrlno]) }}" method="POST" id="delete_children_form{{$newChildrenRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteChildButton{{$newChildrenRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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