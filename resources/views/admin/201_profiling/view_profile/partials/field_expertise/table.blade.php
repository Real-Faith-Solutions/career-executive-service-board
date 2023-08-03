@extends('layouts.app')
@section('title', 'Field Expertise')
@section('sub', 'Field Expertise')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('expertise.create', ['cesno' => $cesno]) }}" class="btn btn-primary" >Add Field Expertise</a>
</div>

<div class="taw-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Expertise / Field of Specialization
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expertise as $expertised)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $expertised->Title}}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('expertise.edit', ['cesno'=>$expertised->profile_tblExpertise->personal_data_cesno, 'speXpCode'=>$expertised->profile_tblExpertise->specialization_code]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>
                        
                            <form action="{{ route('expertise.destroy', ['cesno'=>$expertised->profile_tblExpertise->personal_data_cesno, 'speXpCode'=>$expertised->profile_tblExpertise->specialization_code]) }}" method="POST">
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