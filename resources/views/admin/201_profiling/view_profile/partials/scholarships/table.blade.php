<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormScholarships()">Add Scholarship</button>
    <button class="btn btn-primary hidden" onclick="openTableScholarships()">Go back</button>
</div>

<div class="form-scholarship hidden">
    @include('admin.201_profiling.view_profile.partials.scholarships.form')
</div>

<div class="table-scholarship relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Scholarship Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($scholarship as $scholarships)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $scholarships->type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarships->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarships->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarships->inclusive_date_from." ".$scholarships->inclusive_date_to }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        
                            <form action="{{ route('scholarship.destroy', ['ctrlno'=>$scholarships->ctrlno]) }}" method="POST">
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
