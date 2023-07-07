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

             {{-- spouse --}}
             @foreach ($SpouseRecords as $newSpouseRecords)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Spouse    
                    </td>
                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->first_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newSpouseRecords->middle_name }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td>
                    
                </tr>
            @endforeach

            {{-- family profile (father and mother) --}}
            @foreach ($familyProfile as $newFamilyProfile)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        <p>Father</p>
                        <p>Mother</p>
                    </td>
                
                    <td class="px-6 py-3">
                        <p>{{ $newFamilyProfile->father_last_name }}</p>
                        <p>{{ $newFamilyProfile->mother_last_name }}</p>
                    </td>

                    <td class="px-6 py-3">
                        <p>{{ $newFamilyProfile->father_first_name }}</p>
                        <p>{{ $newFamilyProfile->mother_first_name }}</p>
                    </td>

                    <td class="px-6 py-3">
                        <p>{{ $newFamilyProfile->name_extension }}</p>
                    </td>

                    <td class="px-6 py-3">
                        <p>{{ $newFamilyProfile->father_middle_name }}</p>
                        <p>{{ $newFamilyProfile->mother_middle_name }}</p>
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td>
                    
                </tr>
            @endforeach

            {{-- children records --}}
            @foreach ($ChildrenRecords as $newChildrenRecords)
                <tr class="border-b bg-white">

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        Children    
                    </td>
                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->last_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->first_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->name_extension }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $newChildrenRecords->middle_name }}
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
