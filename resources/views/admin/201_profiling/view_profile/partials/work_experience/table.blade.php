<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormWorkExperience()">Add Research and Studies</button>
    <button class="btn btn-primary hidden" onclick="openTableWorkExperience()">Go back</button>
</div>

<div class="form-work-experience hidden">
    @include('admin.201_profiling.view_profile.partials.work_experience.form')
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
                            <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>

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
