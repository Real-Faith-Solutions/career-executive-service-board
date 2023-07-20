<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormEligibilityAndRankTracker()">Add Eligibility and Rank Tracker</button>
    <button class="btn btn-primary hidden" onclick="openTableEligibilityAndRankTracker()">Go back</button>
</div>

<div class="form-eligibility-and-rank-tracker hidden">
    @include('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.form')
</div>

<div class="table-eligibility-and-rank-tracker">
    <h1 class="mx-2 text-blue-500 text-bold">CES Status</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        CES Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acquired Thru
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Appointing Authority
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Resolution No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date Acquired
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personalData as $personalDatas) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $personalDatas->cesStatusCode->code ?? }}
                        </td>

                        {{-- <td class="px-6 py-3">
                            {{ $newCesStatusCode->profile_tblCESstatus->acc_code }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $newCesStatusCode->profile_tblCESstatus->type_code }}
                        </td>

                        <td class="px-6 py-3">
                           {{ $newCesStatusCode->profile_tblCESstatus->official_code }}
                        </td>

                        <td class="px-6 py-3">
                           {{ $newCesStatusCode->profile_tblCESstatus->resolution_no }}
                       </td>

                       <td class="px-6 py-3">
                           {{ $newCesStatusCode->profile_tblCESstatus->appointed_dt }}
                       </td>

                       <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                                    
                                <form action="{{ route('eligibility-rank-tracker.detach', ['cesno'=>$newCesStatusCode->profile_tblCESstatus->cesno,
                                'cesstat_code'=>$newCesStatusCode->profile_tblCESstatus->cesstat_code,'acc_code'=>$newCesStatusCode->profile_tblCESstatus->acc_code, 
                                'type_code'=>$newCesStatusCode->profile_tblCESstatus->type_code, 'official_code'=>$newCesStatusCode->profile_tblCESstatus->official_code,]) }}" method="POST">
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
                    </tr>                   
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker-1">
    <h1 class="mx-2 text-blue-500 text-bold">CES WE (Historical Record)</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">

            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Examination Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rating Definition
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Place of Examination
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Take No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker-2">
    <h1 class="mx-2 text-blue-500 text-bold">Assessment Center (Historical Record)</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">

            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        AC No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Assessment Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Competencies for D.O.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker-3">
    <h1 class="mx-2 text-blue-500 text-bold">Validation (Historical Record)</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">

            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Validation Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type of Validation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Result
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker-4">
    <h1 class="mx-2 text-blue-500 text-bold">Board Interview</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">

            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Board Interview Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>
