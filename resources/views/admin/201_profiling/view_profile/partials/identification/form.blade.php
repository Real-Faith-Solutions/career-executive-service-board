<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Identification Cards
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('personal-data-identification.store', ['cesno'=>$mainProfile->cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="gsis">GSIS ID No. <sup>*</sup></label>
                        <input id="gsis" name="gsis" type="text" value="{{ old('gsis') ?? $identification->gsis  }}" oninput="validateInput(gsis, 9, 'all')" onkeypress="validateInput(gsis, 9, 'all')" onblur="checkErrorMessage(gsis)">
                        <p class="input_error text-red-600"></p>
                    </div>
                    <div class="mb-3">
                        <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
                        <input id="pagibig" name="pagibig" type="text" value="{{ old('pagibig') ?? $identification->pagibig   }}" oninput="validateInput(pagibig, 9, 'all')" onkeypress="validateInput(pagibig, 9, 'all')" onblur="checkErrorMessage(pagibig)">
                        <p class="input_error text-red-600"></p>
                    </div>
    
                    <div class="mb-3">
                        <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
                        <input id="philhealth" name="philhealth" type="text" value="{{ old('philhealth') ?? $identification->philhealth   }}" oninput="validateInput(philhealth, 9, 'all')" onkeypress="validateInput(philhealth, 9, 'all')" onblur="checkErrorMessage(philhealth)">
                        <p class="input_error text-red-600"></p>
                    </div>
    
                </div>
    
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="col-md-4">
                        <label for="sss_no">SSS ID No.</label>
                        <input id="sss_no" name="sss_no" type="text" value="{{ old('sss_no') ?? $identification->sss_no   }}" oninput="validateInput(sss_no, 9, 'all')" onkeypress="validateInput(sss_no, 9, 'all')" onblur="checkErrorMessage(sss_no)">
                        <p class="input_error text-red-600"></p>
                    </div>
                    <div class="col-md-4">
                        <label for="tin">TIN ID No.</label>
                        <input id="tin" name="tin" type="text" value="{{ old('tin') ?? $identification->tin   }}" oninput="validateInput(tin, 9, 'all')" onkeypress="validateInput(tin, 9, 'all')" onblur="checkErrorMessage(tin)">
                        <p class="input_error text-red-600"></p>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
