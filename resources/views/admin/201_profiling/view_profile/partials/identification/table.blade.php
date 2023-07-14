<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormIdentification()">Add Identification</button>
    <button class="btn btn-primary hidden" onclick="openTableIdentification()">Go back</button>
</div>

<div class="form-identification hidden">
    @include('admin.201_profiling.view_profile.partials.identification.form')
</div>

<div class="table-identification relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Type
                </th>

                <th class="px-6 py-3" scope="col">
                    ID Number
                </th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($identification as $newIdentification)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $newIdentification->type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newIdentification->id_number }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <a class="mx-1 font-medium text-blue-600 hover:underline" href="#">Update</a>
                        
                            <form action="{{ route('personal-data-identification.destroy', ['ctrlno'=>$newIdentification->ctrlno]) }}" method="POST">
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
