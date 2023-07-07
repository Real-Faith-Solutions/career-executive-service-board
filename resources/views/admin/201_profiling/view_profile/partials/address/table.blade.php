<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormAddress()">Add Address</button>
    <button class="btn btn-primary hidden" onclick="openTableAddress()">Go back</button>
</div>

<div class="form-address hidden">
    @include('admin.201_profiling.view_profile.partials.address.form')
</div>

<div class="table-address relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Type
                </th>
                <th class="px-6 py-3" scope="col">
                    Floor / Bldg
                </th>
                <th class="px-6 py-3" scope="col">
                    No. / Street
                </th>
                <th class="px-6 py-3" scope="col">
                    Brgy. / District
                </th>
                <th class="px-6 py-3" scope="col">
                    City Municipality
                </th>
                <th class="px-6 py-3" scope="col">
                    Zip Code
                </th>
                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($addressProfile as $data)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
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
                        <a class="mx-1 font-medium text-blue-600 hover:underline" href="#">Update</a>
                        <a class="mx-1 font-medium text-red-600 hover:underline" href="#">Delete</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
