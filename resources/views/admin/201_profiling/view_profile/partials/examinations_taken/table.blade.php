<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormExaminationsTaken()">Add Examination Taken</button>
    <button class="btn btn-primary hidden" onclick="openTableExaminationsTaken()">Go back</button>
</div>

<div class="form-examinations-taken hidden">
    @include('admin.201_profiling.view_profile.partials.examinations_taken.form')
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
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr class="border-b bg-white">
                <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                    Lorem ipsum dolor
                </td>

                <td class="px-6 py-3">
                    Lorem ipsum dolor
                </td>

                <td class="px-6 py-3">
                    Lorem ipsum dolor
                </td>

                <td class="px-6 py-3">
                    Lorem ipsum dolor
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                    <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                </td>
            </tr>

        </tbody>
    </table>
</div>
