<div id="large-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-medium text-gray-900">
                    Agency Location Manager
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                    data-modal-hide="large-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <form action="{{ route('agency-location-manager.store', ['deptid' => $department->deptid]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" id="title" name="deptid" required readonly value="{{ $department->deptid }}" />
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mb-3">
                            <label for="title">Location<sup>*</sup></label>
                            <input id="title" name="title" required />
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="acronym">Acronym<sup>*</sup></label>
                            <input id="acronym" name="acronym" minlength="2" maxlength="10" required />
                            @error('acronym')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="agencyloc_Id">Agency Type<sup>*</sup></label>
                            <select id="agencyloc_Id" name="agencyloc_Id" required>
                                @foreach ($agencyLocationLibrary as $data)
                                <option value="{{ $data->agencyloc_Id }}">{{ $data->title }}</option>

                                @endforeach
                            </select>
                            @error('agencyloc_Id')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telno">Telno</label>
                            <input id="telno" name="telno" type="tel" />
                            @error('telno')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" />
                            @error('email')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="region">Region<sup>*</sup></label>
                            <select id="region" name="region" type="region" required>
                                <option disabled selected>Select Region</option>
                                <option value="NCR">NCR</option>
                            </select>
                            @error('region')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>