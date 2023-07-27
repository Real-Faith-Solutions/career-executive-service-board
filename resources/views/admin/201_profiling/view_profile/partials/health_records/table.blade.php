<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormHealthRecord()">Add Health Record</button>
    <button class="btn btn-primary hidden" onclick="openTableHealthRecord()">Go back</button>
</div>

<div class="form-health-record hidden">
    @include('admin.201_profiling.view_profile.partials.health_records.form')
</div>

<div class="table-health-record relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Blood Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Identifying Marks
                </th>

                <th scope="col" class="px-6 py-3">
                    Disabilities
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b bg-white">
                
                @if ($healthRecord)
                    <td class="px-6 py-3">{{ $healthRecord ? $healthRecord->blood_type : 'None' }}</td>
                    <td class="px-6 py-3">{{ $healthRecord ? $healthRecord->identifying_marks : 'None' }}</td>
                    <td class="px-6 py-3">{{ $healthRecord ? $healthRecord->person_with_disability : 'None' }}</td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        
                            <form action="{{ route('health-record.destroy', ['ctrlno'=>$healthRecord->ctrlno]) }}" method="POST">
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
                    </td> --}}
                @else
                    <td colspan="4" class="px-6 py-3 text-center bg-neutral-100">No Records</td>
                @endif

            </tr>
        </tbody>
    </table>
</div>
