@extends('layouts.app')
@section('title', 'Affiliation')
@section('sub', 'Affiliation')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('affiliations.recycleBin', ['cesno'=>$cesno]) }}" method="GET">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('affiliation.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add Affiliations</a>
</div>

<div class="table-major-civic-and-professional-affiliations relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
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
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($affiliation as $affiliations)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $affiliations->organization }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliations->position }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliations->from_dt." - ".$affiliations->to_dt }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('affiliation.edit', ['ctrlno'=>$affiliations->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('affiliation.destroy', ['ctrlno'=>$affiliations->ctrlno]) }}" method="POST" id="delete_affiliation_form{{$affiliations->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteAffiliationButton{{$affiliations->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
    {{ $affiliation->links() }}
</div>

@endsection