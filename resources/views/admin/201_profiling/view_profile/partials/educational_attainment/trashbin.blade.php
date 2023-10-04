@extends('layouts.app')
@section('title', 'Educational Attainment Recycle Bin')
@section('sub', 'Educational Attainment Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('educational-attainment.index', ['cesno' => $cesno]) }}" class="btn btn-primary mb-7">Go Back</a>
</div>

<div class="table-educational-attainment relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Level
                </th>

                <th scope="col" class="px-6 py-3">
                    School
                </th>

                <th scope="col" class="px-6 py-3">
                    Course
                </th>

                <th scope="col" class="px-6 py-3">
                    Degree
                </th>

                <th scope="col" class="px-6 py-3">
                    School Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Degree Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Period of Attendance
                </th>

                <th scope="col" class="px-6 py-3">
                    Academic Honor Received
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
            @foreach ($educationAttainmentTrashedRecord as $educationAttainmentTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $educationAttainmentTrashedRecords->level }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->profileLibTblEducSchool->SCHOOL }}
                    </td>
                    
                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->profileLibTblEducMajor->COURSE }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->profileLibTblEducDegree->DEGREE }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->school_status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->degree_status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->period_of_attendance_from." - ".$educationAttainmentTrashedRecords->year_grad }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->honors }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $educationAttainmentTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('educational-attainment.restore', ['ctrlno'=>$educationAttainmentTrashedRecords->ctrlno]) }}" method="POST" id="restore_educational_attainment_form{{$educationAttainmentTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreEducAttainmentButton{{$educationAttainmentTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                    
                            <form action="{{ route('educational-attainment.forceDelete', ['ctrlno'=>$educationAttainmentTrashedRecords->ctrlno]) }}" method="POST" id="permanent_delete_educational_attainment_form{{$educationAttainmentTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteEducationAttainmentButton{{$educationAttainmentTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">  
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/jmkrnisz.json"
                                        trigger="hover"
                                        colors="primary:#DC3545"
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
