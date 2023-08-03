@extends('layouts.app')
@section('title', 'Identification Cards')
@section('sub', 'Identification Cards')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormIdentification()">Add Identification Card</button>
    <button class="btn btn-primary hidden" onclick="openTableIdentification()">Go back</button>
</div>

<div class="form-identification hidden">
    @include('admin.201_profiling.view_profile.partials.identification.form')
</div>

<div class="table-identification relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    ID Type
                </th>

                <th class="px-6 py-3" scope="col">
                    ID Number
                </th>

                {{-- <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th> --}}
            </tr>
        </thead>

        <tbody>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">GSIS</td>
                <td class="px-6 py-3">{{ $identification ? $identification->gsis : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">PAG-IBIG</td>
                <td class="px-6 py-3">{{ $identification ? $identification->pagibig : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">PHILHEALTH</td>
                <td class="px-6 py-3">{{ $identification ? $identification->philhealth : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">SSS</td>
                <td class="px-6 py-3">{{ $identification ? $identification->sss_no : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">TIN</td>
                <td class="px-6 py-3">{{ $identification ? $identification->tin : 'None' }}</td>
            </tr>

            {{-- @foreach ($identification as $newIdentification)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $newIdentification->type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newIdentification->id_number }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('personal-data-identification.edit', ['ctrlno'=>$newIdentification->ctrlno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                   UPDATE
                                </button>
                            </form>
                        
                            <form action="{{ route('personal-data-identification.destroy', ['ctrlno'=>$newIdentification->ctrlno]) }}" method="POST">
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
            @endforeach --}}
        </tbody>
    </table>
</div>

@endsection
