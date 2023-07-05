<div class="my-5 flex justify-end">
    <button class="btn btn-primary">Add Address</button>
</div>

<div class="relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Floor / Bldg
                </th>
                <th scope="col" class="px-6 py-3">
                    No. / Street
                </th>
                <th scope="col" class="px-6 py-3">
                    Brgy. / District
                </th>
                <th scope="col" class="px-6 py-3">
                    City Municipality
                </th>
                <th scope="col" class="px-6 py-3">
                    Zip Code
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($addressProfile as $data)
            <tr class="border-b bg-white">
                <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                    {{ $data->type }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->floor_bldg }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->no_street }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->brgy_or_district }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->city_or_municipality }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->zip_code }}
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                    <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>
