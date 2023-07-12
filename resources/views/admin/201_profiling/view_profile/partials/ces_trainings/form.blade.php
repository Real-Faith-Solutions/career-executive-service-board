<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form CES Training
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="session_title_or_program">Session Title / Program</label>
                        <input id="session_title_or_program" name="session_title_or_program" type="text" required>
                        @error('session_title_or_program')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="session_number">Session Number<sup>*</span></label>
                        <input id="session_number" name="session_number" type="number" required>
                        @error('session_number')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="training_category_or_theme">Training Category / Theme<sup>*</span></label>
                        <select id="training_category_or_theme" name="training_category_or_theme" required>
                            <option disabled selected>Select Training Category / Theme</option>
                        </select>
                        @error('training_category_or_theme')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="expertise_field_of_specialization">Expertise / Field of Specialization<sup>*</span></label>
                        <input id="expertise_field_of_specialization" name="expertise_field_of_specialization" type="text" required>
                        @error('expertise_field_of_specialization')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)<sup>*</span></label>
                        <input id="inclusive_date_from" name="inclusive_date_from" type="date" required>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</span></label>
                        <input id="inclusive_date_to" name="inclusive_date_to" type="date" required>
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="venue">Venue</label>
                        <input id="venue" name="venue" type="text" required>
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_of_training_hours">No. of Training Hours<sup>*</span></label>
                        <input id="no_of_training_hours" name="no_of_training_hours" type="number" required>
                        @error('no_of_training_hours')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="barrio">Barrio<sup>*</span></label>
                        <input id="barrio" name="barrio" type="text" required>
                        @error('barrio')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="resource_speaker">Resource Speaker</label>
                        <input id="resource_speaker" name="resource_speaker" type="text" required>
                        @error('resource_speaker')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="session_director">Session Director<sup>*</span></label>
                        <input id="session_director" name="session_director" type="number" required>
                        @error('session_director')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="training_status">Training Status<sup>*</span></label>
                        <select id="training_status" name="training_status" required>
                            <option disabled selected>Select Training Status</option>
                        </select>
                        @error('training_status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</span></label>
                        <input id="remarks" name="remarks" type="text" required>
                        @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="flex justify-end">
                    <button class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
