@extends('layouts.app')
@section('title', 'Rank Tracker - Eris Library')
@section('content')

<div class="my-5 flex justify-end gap-4">
    {{-- trash bin icon --}}
    <a href="{{ route('rank-tracker-library.recentlyDeleted') }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
        </lord-icon>
    </a>

    <a class="btn btn-primary" href="{{ route('rank-tracker-library.create') }}">Add New Rank</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Description
                </th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($libraryRankTracker as $libraryRankTrackers)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $libraryRankTrackers->description }}
                    </td>
                    
                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <form action="{{ route('rank-tracker-library.edit', ['code'=>$libraryRankTrackers->ctrlno]) }}" method="GET">
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

                            <form action="{{ route('rank-tracker-library.destroy', ['code'=>$libraryRankTrackers->ctrlno]) }}" method="POST" id="delete_case_nature_form{{$libraryRankTrackers->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteCaseNatureButton{{$libraryRankTrackers->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

<div class="m-5">
    {{ $libraryRankTracker->links() }}
</div>

@endsection
