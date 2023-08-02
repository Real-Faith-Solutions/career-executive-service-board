@extends('layouts.app')
@section('title', 'Work Experience')
@section('sub', 'Work Experience')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('work-experience.recycleBin', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('work-experience.create', ['cesno'=>$cesno]) }}" class="btn btn-primary">Add Work and Experience</a>
</div>

<div class="table-work-experience relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
                </th>

                <th scope="col" class="px-6 py-3">
                    Position Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Department Agency
                </th>

                <th scope="col" class="px-6 py-3">
                    Monthly Salary
                </th>

                <th scope="col" class="px-6 py-3">
                    Salary Grade
                </th>

                <th scope="col" class="px-6 py-3">
                    Status of Appointment
                </th>

                <th scope="col" class="px-6 py-3">
                    Government Service
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

            @foreach ($workExperience as $workExperiences)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $workExperiences->from_dt." - ".$workExperiences->to_dt }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->designation }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->department }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->monthly_salary }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->salary }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->government_service }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $workExperiences->remarks }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('work-experience.edit', ['ctrlno'=>$workExperiences->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('work-experience.destroy', ['ctrlno'=>$workExperiences->ctrlno]) }}" method="POST">
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