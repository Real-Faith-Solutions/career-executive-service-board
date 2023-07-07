<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormEducationalAttainment()">Add Educational Attainment</button>
    <button class="btn btn-primary hidden" onclick="openTableEducationalAttainment()">Go back</button>
</div>

<div class="form-educational-attainment hidden">
    @include('admin.201_profiling.view_profile.partials.educational_attainment.form')
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
                        {{ $newEducationalAttainment->school }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newEducationalAttainment->school_type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newEducationalAttainment->period_of_attendance_from." ".$newEducationalAttainment->period_of_attendance_to }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        
                         <form action="{{ route('educational-attainment.destroy', ['ctrlno'=>$newEducationalAttainment->ctrlno]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="mx-1 font-medium text-red-600 hover:underline" type="submit">DELETE</button>
                        </form>
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>
