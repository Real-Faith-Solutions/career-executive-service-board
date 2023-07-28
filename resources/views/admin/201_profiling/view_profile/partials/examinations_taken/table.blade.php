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
            @foreach ($examinationTaken as $examinationTakens)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $examinationTakens->profileLibTblExamRefPersonalData->TITLE }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakens->rating }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakens->date_of_examination }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $examinationTakens->place_of_examination }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('examination-taken.edit', ['ctrlno'=>$examinationTakens->ctrlno]) }}" method="GET">
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
                        
                            <form action="{{ route('examination-taken.destroy', ['ctrlno'=>$examinationTakens->ctrlno]) }}" method="POST">
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
