@extends('layouts.app')
@section('title', 'CES Training')
@section('sub', 'CES Training')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('ces-training-201.recentlyDeleted', ['cesno'=>$cesno]) }}">
        <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
            style="width:34px;height:34px">
        </lord-icon>
    </a>

    <a href="{{ route('ces-training-201.create', ['cesno' => $cesno]) }}" class="btn btn-primary">Add CES Training</a>
</div>

<div class="table-ces-trainings relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Session Title / Program
                </th>

                <th scope="col" class="px-6 py-3">
                    Session number
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Category / Theme
                </th>

                <th scope="col" class="px-6 py-3">
                    Expertise / Field of Specialization
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive dates
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Training Hours
                </th>

                <th scope="col" class="px-6 py-3">
                    Barrio
                </th>

                <th scope="col" class="px-6 py-3">
                    Resource Speaker
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Director
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cesTraining as $cesTrainings)
            <tr class="border-b bg-white">
                <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                    {{ $cesTrainings->title ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->sessionid ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->category ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->specialization ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ \Carbon\Carbon::parse($cesTrainings->from_dt)->format('m/d/Y') ?? 'No Record' }} -
                    {{ \Carbon\Carbon::parse($cesTrainings->to_dt)->format('m/d/Y') ?? 'No Record' }}
                    
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->venuePersonalData->name ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->no_hours ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->barrio ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->resourceSpeakerPersonalData->lastname ?? 'No Record' }},
                    {{ $cesTrainings->resourceSpeakerPersonalData->firstname ?? 'No Record' }},
                    {{ $cesTrainings->resourceSpeakerPersonalData->mi ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->session_director ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->status ?? 'No Record' }}
                </td>

                <td class="px-6 py-3">
                    {{ $cesTrainings->remarks ?? 'No Record' }}
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex">
                        {{-- <form
                            action="{{ route('ces-training-201.edit', ['cesno'=>$cesno, 'ctrlno'=>$cesTrainings->pid]) }}"
                            method="GET">
                            @csrf
                            <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                                    colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                    style="width:30px;height:30px">
                                </lord-icon>
                            </button>
                        </form>

                        <form action="{{ route('ces-training-201.destroy', ['ctrlno'=>$cesTrainings->pid]) }}"
                            method="POST" id="delete_ces_training_201_form{{$cesTrainings->pid}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="deleteCesTraining201Button{{$cesTrainings->pid}}"
                                onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                    colors="primary:#880808" style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="m-5">
    {{ $cesTraining->links() }}
</div>

@endsection