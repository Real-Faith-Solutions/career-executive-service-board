<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormLanguageDialect()">Add Language Dialect</button>
    <button class="btn btn-primary hidden" onclick="openTableLanguageDialect()">Go back</button>
</div>

<div class="form-language-dialect hidden">
    @include('admin.201_profiling.view_profile.partials.languages_dialects.form')
</div>

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($language as $languages)
                <tr class="border-b bg-white">
                    <td class="px-6 py-3">
                       {{  $languages->language_description }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>

                            <form action="{{ route('language.destroy', ['ctrlno'=>$languages->ctrlno]) }}" method="POST">
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
