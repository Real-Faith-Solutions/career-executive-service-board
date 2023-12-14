

<!-- Modal toggle -->
<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="mx-1 font-medium text-red-600 hover:underline" title="Delete Record" type="button">

<lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
    colors="primary:#DC3545" style="width:24px;height:24px">
</lord-icon>
</button>

<!-- Main modal -->
<form action="{{ route('appointee-occupant-manager.destroy', ['appointee_id' => $appointee_id]) }}"
    method="post"
    id="default-modal"
    tabindex="-1"
    aria-hidden="true"
    onsubmit="return window.confirm('Are you sure you want to delete? This action cannot be undone')"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    
    @method('DELETE')
    @csrf
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Reason Codes
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="mb-3">
                    <label for="subject">Reason codes<sup>*</sup></label>
                    <select name="subject" id="subject" required>
                        @foreach($reasonCode as $data)
                            <option value="{{ $data->title }}">
                                {{ $data->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="effect_dt">Effectivity Date<sup>*</sup></label>
                    <input name="effect_dt" id="effect_dt" type="date" required/>
                </div>

                <div class="mb-3">
                    <label for="notes">Notes<sup>*</sup></label>
                    <textarea name="notes" id="notes" required></textarea>
                </div>
                
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end gap-2 p-4 md:p-5 border-t border-gray-200 rounded-b">
                <button type="submit" class="btn btn-primary">Confirm deletion</button>
                <button data-modal-hide="default-modal" type="button" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>
</form>
