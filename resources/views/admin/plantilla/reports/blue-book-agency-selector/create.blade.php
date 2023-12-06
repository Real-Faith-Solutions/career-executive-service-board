


<!-- Modal toggle -->
<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="btn btn-primary" type="button">
    Add Department For Bluebook Selector
  </button>
  
  <!-- Main modal -->
  <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <form action="{{ route('blue-book-selector.setAsNational', ['deptid' => ':deptid']) }}" method="post" class="relative bg-white rounded-lg shadow dark:bg-gray-700" id="nationalForm">
            @csrf
             
            <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Blue book Selector
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
                    <label for="is_national">Select Department</label>
                    <select name="is_national" id="is_national" onchange="isNational(this.value)" required>
                        <option value="" selected>Select Department</option>
                        @foreach ($motherDepartmentAgencySelector as $data)
                            <option value="{{ $data->deptid }}">
                                {{ $data->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('is_national')
                        <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                </div>
                
                    
                  
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button data-modal-hide="default-modal" type="submit" class="btn btn-primary">
                    Submit
                  </button>
                  <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Close
                  </button>
              </div>
          </form>
      </div>
  </div>
  
  <script>
    function isNational(val) {
        const form = document.querySelector("#nationalForm");
        form.action = form.action.replace(':deptid', val);
    }
</script>