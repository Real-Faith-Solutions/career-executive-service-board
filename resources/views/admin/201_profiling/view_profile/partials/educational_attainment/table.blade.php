@extends('layouts.app')
@section('title', 'Educational Attainment')
@section('sub', 'Educational Attainment')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('educational-attainment.recycleBin', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('educational-attainment.form', ['cesno' => $cesno]) }}" class="btn btn-primary">Add Educational Attainment</a>
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
                    School Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Period of Attendance
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($educationalAttainment as $newEducationalAttainment)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $newEducationalAttainment->level }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newEducationalAttainment->profileLibTblEducSchool->SCHOOL }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newEducationalAttainment->school_type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newEducationalAttainment->period_of_attendance_from." - ".$newEducationalAttainment->period_of_attendance_to }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">

                        <div class="flex">
                            <form action="{{ route('educational-attainment.edit', ['ctrlno'=>$newEducationalAttainment->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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
                       
                            <form action="{{ route('educational-attainment.destroy', ['ctrlno'=>$newEducationalAttainment->ctrlno]) }}" method="POST"  id="delete_educational_attainment_form{{$newEducationalAttainment->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteEducAttainmentButton{{$newEducationalAttainment->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">  
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