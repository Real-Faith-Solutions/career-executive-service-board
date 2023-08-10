@extends('layouts.app')
@section('title', 'Research and Studies')
@section('sub', 'Research and Studies')
@section('content')
    @include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

    <div class="my-5 flex justify-end">
        <a href="{{ route('research-studies.recycleBin', ['cesno' => $cesno]) }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a href="{{ route('research-studies.create', ['cesno' => $cesno]) }}" class="btn btn-primary">Add Research and
            Studies</a>
    </div>

    <div class="table-research-and-studies relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
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
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($researchAndStudies as $researchAndStudy)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $researchAndStudy->title }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $researchAndStudy->publisher }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $researchAndStudy->inclusive_date_from . ' - ' . $researchAndStudy->inclusive_date_to }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form
                                    action="{{ route('research-studies.edit', ['ctrlno' => $researchAndStudy->ctrlno, 'cesno' => $cesno]) }}"
                                    method="GET">
                                    @csrf
                                    <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                        <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                                            colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                            style="width:30px;height:30px">
                                        </lord-icon>
                                    </button>
                                </form>

                                <form
                                    action="{{ route('research-studies.destroy', ['ctrlno' => $researchAndStudy->ctrlno]) }}"
                                    method="POST" id="delete_scholarships_form{{ $researchAndStudy->ctrlno }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteResearchAndStudyButton{{ $researchAndStudy->ctrlno }}"
                                        onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                        <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                            colors="primary:#880808" style="width:24px;height:24px">
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
