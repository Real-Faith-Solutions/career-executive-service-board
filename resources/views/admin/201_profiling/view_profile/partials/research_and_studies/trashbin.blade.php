@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="mb-7">
    <h1>RESEARCH AND STUDIES RECYLE BIN</h1>
</div>

<div class="table-research-and-studies relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Control No
                </th>

                <th scope="col" class="px-6 py-3">
                    Research Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Publisher
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
            @foreach ($researchAndStudiesTrashedRecord as $researchAndStudiesTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $researchAndStudiesTrashedRecords->ctrlno }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $researchAndStudiesTrashedRecords->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $researchAndStudiesTrashedRecords->publisher }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $researchAndStudiesTrashedRecords->inclusive_date_from." - ".$researchAndStudiesTrashedRecords->inclusive_date_to }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $researchAndStudiesTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('research-studies.restore', ['ctrlno'=>$researchAndStudiesTrashedRecords->ctrlno]) }}" method="POST">
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

                            <form action="{{ route('research-studies.forceDelete', ['ctrlno'=>$researchAndStudiesTrashedRecords->ctrlno]) }}" method="POST">
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