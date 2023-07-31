@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="mb-7">
    <h1>FAMILY PROFILE RECYCLE BIN</h1>
</div>

<div class="table-family-profile relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Relationship
                </th>

                <th scope="col" class="px-6 py-3">
                    Control No
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
                    Deleted At
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>

        <tbody>

             {{-- spouse --}}
             @foreach ($spousesTrashedRecord as $spousesTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Spouse
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $spousesTrashedRecords->ctrlno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $spousesTrashedRecords->last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $spousesTrashedRecords->first_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $spousesTrashedRecords->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $spousesTrashedRecords->middle_name }}`
                    </td>

                    <td class="px-6 py-3">
                        {{ $spousesTrashedRecords->deleted_at }}`
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('family-profile-spouse.restore', ['ctrlno'=>$spousesTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('family-profile-spouse.forceDelete', ['ctrlno'=>$spousesTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="mx-1 font-medium text-red-600 hover:underline" type="submit">
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
            @foreach ($childrensTrashedRecord as $childrensTrashedRecords)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Children
                    </td>

                    <td class="px-6 py-3">
                        {{ $childrensTrashedRecords->ctrlno }}
                    </td>
                    
                    <td class="px-6 py-3">
                        {{ $childrensTrashedRecords->last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $childrensTrashedRecords->first_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $childrensTrashedRecords->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $childrensTrashedRecords->middle_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $childrensTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('family-profile-children.restore', ['ctrlno'=>$childrensTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('family-profile-children.forceDelete', ['ctrlno'=>$childrensTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="mx-1 font-medium text-red-600 hover:underline" type="submit">
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