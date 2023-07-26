<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormManagementTraining()">Add Management Training</button>
    <button class="btn btn-primary hidden" onclick="openTableManagementTraining()">Go back</button>
</div>

<div class="form-management-training hidden">
    @include('admin.201_profiling.view_profile.partials.other_management_trainings.form')
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Training Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Category
                </th>

                <th scope="col" class="px-6 py-3">
                    Expertise/Field of Specialization
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor/Training Provider
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Training Hours
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($otherTraining as $otherTrainings)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $otherTrainings->training }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->training_category }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->field_specialization }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->venue }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $otherTrainings->no_training_hours }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('other-training.edit', ['ctrlno'=>$otherTrainings->ctrlno]) }}" method="GET">
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

                            <form action="{{ route('other-training.destroy', ['ctrlno'=>$otherTrainings->ctrlno]) }}" method="POST">
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
