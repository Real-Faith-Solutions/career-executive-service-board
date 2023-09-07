<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Family Profile
            </h1>
        </div>

        <div class="bg-white px-6 py-3">

            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="mb-3">
                    <label for="relationship">Relationship<sup>*</span></label>
                    <select id="relationship" name="relationship" required onchange="toggleRelationshipStatus(this.value)">
                        {{-- <option disabled selected>Select Relationship</option> --}}
                        <option value="Children" selected>Children</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Spouse">Spouse</option>
                    </select>
                </div>
            </div>

            <div class="children">
                @include('admin.201_profiling.view_profile.partials.family_profile.create_children')
            </div>
            <div class="father hidden">
                @include('admin.201_profiling.view_profile.partials.family_profile.create_father')
            </div>
            <div class="mother hidden">
                @include('admin.201_profiling.view_profile.partials.family_profile.create_mother')
            </div>
            <div class="spouse hidden">
                @include('admin.201_profiling.view_profile.partials.family_profile.create_spouse')
            </div>

        </div>
    </div>
</div>
