@extends('layouts.app')
@section('title', 'Examination Taken Recycle Bin')
@section('sub', 'Examination Taken Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('examination-taken.index', ['cesno' => $cesno]) }}" class="btn btn-primary mb-7">Go back</a>
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
                    Deleted At
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examinationTakensTrashedRecord as $examinationTakensTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $examinationTakensTrashedRecords->profileLibTblExamRefPersonalData->TITLE }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->rate ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->exam_date ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->exam_place ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->license_number ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->date_acquired ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->date_validity ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakensTrashedRecords->deleted_at ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('examination-taken.restore', ['ctrlno'=>$examinationTakensTrashedRecords->ctrlno]) }}" method="POST" id="restore_examinations_taken_form{{$examinationTakensTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreExamTakenButton{{$examinationTakensTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                        
                            <form action="{{ route('examination-taken.forceDelete', ['ctrlno'=>$examinationTakensTrashedRecords->ctrlno]) }}" method="POST" id="permanent_delete_examinations_taken_form{{$examinationTakensTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteExamTakenButton{{$examinationTakensTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
    {{ $examinationTakensTrashedRecord->links() }}
</div>

@endsection