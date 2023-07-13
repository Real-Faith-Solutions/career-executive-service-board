<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormMajorCivilAndProfessionalAffiliation()">Add Major Civic and Professional Affiliations</button>
    <button class="btn btn-primary hidden" onclick="openTableMajorCivilAndProfessionalAffiliation()">Go back</button>
</div>

<div class="form-major-civic-and-professional-affiliations hidden">
    @include('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.form')
</div>

<div class="table-major-civic-and-professional-affiliations relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Organization
                </th>

                <th scope="col" class="px-6 py-3">
                    Position
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

            @foreach ($affiliation as $affiliations)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $affiliations->organization }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliations->position }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliations->from_dt." - ".$affiliations->to_dt }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>

                        <form action="{{ route('affiliation.destroy', ['ctrlno'=>$affiliations->ctrlno]) }}" method="POST">
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
