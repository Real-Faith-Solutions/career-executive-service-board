<div class="my-5 flex justify-end">
    <a href="{{ route('family-profile.create', ['cesno'=>$mainProfile->cesno])}}" class="btn btn-primary">Add Family profile</a>
</div>

<div class="relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Relationship
                </th>
                <th scope="col" class="px-6 py-3">
                    Lastname
                </th>
                <th scope="col" class="px-6 py-3">
                    Firstname
                </th>
                <th scope="col" class="px-6 py-3">
                    Extension name
                </th>
                <th scope="col" class="px-6 py-3">
                    Middlename
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr class="border-b bg-white">
                <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                    Spouse
                </td>
                <td class="px-6 py-3">
                    Spouse name
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
