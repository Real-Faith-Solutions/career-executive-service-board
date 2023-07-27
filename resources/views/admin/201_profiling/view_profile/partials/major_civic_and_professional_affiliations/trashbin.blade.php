@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="mb-7">
    <h1>MAJOR CIVIC AND PROFESSIONAL AFFILLIATIONS RECYLE BIN</h1>
</div>

<div class="table-major-civic-and-professional-affiliations relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                   Control No 
               </th>

                <th scope="col" class="px-6 py-3">
                    Organization
                </th>

                <th scope="col" class="px-6 py-3">
                    Position
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
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
            @foreach ($affiliationsTrashedRecord as $affiliationsTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $affiliationsTrashedRecords->ctrlno }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $affiliationsTrashedRecords->organization }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliationsTrashedRecords->position }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliationsTrashedRecords->from_dt." - ".$affiliationsTrashedRecords->to_dt }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliationsTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('affiliation.restore', ['ctrlno'=>$affiliationsTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('affiliation.forceDelete', ['ctrlno'=>$affiliationsTrashedRecords->ctrlno]) }}" method="POST">
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