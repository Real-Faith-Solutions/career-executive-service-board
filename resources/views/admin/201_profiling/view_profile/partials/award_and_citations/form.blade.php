<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Award and Citation
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="#">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="title_of_award">Title of Award<sup>*</sup></label>
                        <input id="title_of_award" name="title_of_award" required type="text">
                        @error('title_of_award')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sponsor">Sponsor<sup>*</sup></label>
                        <input id="sponsor" name="sponsor" required type="text">
                        @error('sponsor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date">Date<sup>*</sup></label>
                        <input id="date" name="date" required type="date">
                        @error('date')
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
