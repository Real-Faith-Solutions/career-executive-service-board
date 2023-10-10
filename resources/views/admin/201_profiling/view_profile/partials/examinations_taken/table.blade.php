@extends('layouts.app')
@section('title', 'Examination Taken')
@section('sub', 'Examination Taken')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('examination-taken.recentlyDeleted', ['cesno'=>$cesno]) }}" method="GET">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('examination-taken.create', ['cesno' => $cesno]) }}" class="btn btn-primary">Add Examination Taken</a>
</div>

<div class="table-examinations-taken relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Type of Examination
                </th>

                <th scope="col" class="px-6 py-3">
                    Rating
                </th>

                <th scope="col" class="px-6 py-3">
                    Date of Examination
                </th>

                <th scope="col" class="px-6 py-3">
                    Place of Examination
                </th>

                <th scope="col" class="px-6 py-3">
                    License Details
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Acquired
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Validity
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examinationTaken as $examinationTakens)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $examinationTakens->profileLibTblExamRefPersonalData->TITLE ?? 'N/A'}}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakens->rate ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ \Carbon\Carbon::parse($examinationTakens->exam_date)->format('m/d/Y') ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakens->exam_place ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakens->license_number ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ \Carbon\Carbon::parse($examinationTakens->date_acquired)->format('m/d/Y') ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ \Carbon\Carbon::parse($examinationTakens->date_validity)->format('m/d/Y') ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('examination-taken.edit', ['ctrlno'=>$examinationTakens->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('examination-taken.destroy', ['ctrlno'=>$examinationTakens->ctrlno]) }}" method="POST" id="delete_examinations_taken_form{{$examinationTakens->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteExaminationsTakenButton{{$examinationTakens->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
