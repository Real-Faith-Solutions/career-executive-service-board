<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormAwardAndCitation()">Add Award and Citation</button>
    <button class="btn btn-primary hidden" onclick="openTableAwardAndCitation()">Go back</button>
</div>

<div class="form-award-and-citation hidden">
    @include('admin.201_profiling.view_profile.partials.award_and_citations.form')
</div>

<div class="table-award-and-citation relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title of Award
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor
                </th>

                <th scope="col" class="px-6 py-3">
                    Date
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($awardsAndCitation as $awardsAndCitations)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $awardsAndCitations->awards }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $awardsAndCitations->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $awardsAndCitations->date }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        
                        <form action="{{ route('award-citation.destroy', ['ctrlno'=>$awardsAndCitations->ctrlno]) }}" method="POST">
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
