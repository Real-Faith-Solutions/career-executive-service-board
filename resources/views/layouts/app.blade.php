<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('images/branding.png') }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css'>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js'></script>

    {{-- charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- sweet alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script> {{-- lord icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>

<body>
    @include('layouts.tailwindcss')
    @include('layouts.modals')
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')

    {{-- @include('layouts.partials.preloader') --}}

    <div class="p-4 sm:ml-64">
        <div class="mt-14 rounded-lg p-4">
            @yield('content')
        </div>
    </div>

    @if (isset($cesno))
        <!-- Modal for Avatar Upload -->
        <div id="profile-avatar-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
            <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
                <form id="uploadFormAvatar" action="{{ route('/upload-avatar-profile-201', ['cesno'=>$cesno]) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center">
                    @csrf
                    <span class="close-avatar absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
                    <h2 class="text-2xl font-bold mb-4 text-center">Upload New Avatar</h2>
                    <input type="file" id="imageInputAvatar" name="imageInput" class="mb-4 p-2 border border-gray-300 rounded">
                    <p class="text-red-600" id="ErrorMessageAvatar"></p>
                    <div class="flex justify-center items-center mb-4">
                        <img id="imagePreviewAvatar" src="#" alt="Image Preview" class="hidden w-32 h-32 rounded-full">
                    </div>
                    <button type="submit" name="submit" id="uploadButtonAvatar" class="px-6 py-3 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition-colors duration-300">Upload</button>
                </form>
            </div>
        </div>
        {{-- end --}}
    @endif

    {{-- confirmation dialog --}}
    <div id="confirmationBackdrop" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div id="confirmationDialog" class="bg-white w-1/3 p-6 rounded-lg shadow-lg hidden" data-form-id="">
            <h2 class="text-lg font-bold mb-4" id="confirmationDialogTitle"></h2>
            <p class="mb-4" id="confirmationDialogStatement"></p>
            <div class="text-right">
                <button class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg mr-2 hover:bg-gray-400" onclick="closeConfirmationDialog()">No</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" onclick="deleteItem()">Yes</button>
            </div>
        </div>
    </div>
    {{-- end --}}

    @if (isset($cesno))
        <!-- Modal for Adding Medical History -->
        <div id="add-medical-history-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
            <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
                <form id="addMedicalHistoryForm" action="{{ route('medical-history.store', ['cesno'=>$cesno]) }}" method="POST" class="flex flex-col items-center" onsubmit="return checkErrorsBeforeSubmit(addMedicalHistoryForm)">
                    @csrf

                    <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
                    <h2 class="text-2xl font-bold mb-4 text-center">Add Medical History</h2>

                    <div class="sm:gid-cols-1 mb-2 grid gap-4 md:grid-cols-2 lg:grid-cols-2">

                        <div class="mb-2">
                            <input type="text" id="medical_condition_illness" name="medical_condition_illness" oninput="validateInput(medical_condition_illness, 4)" onkeypress="validateInput(medical_condition_illness, 4)" onblur="checkErrorMessage(medical_condition_illness)" required>
                            <p class="input_error text-red-600"></p>
                            @error('medical_condition_illness')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input type="date" id="medical_date" name="medical_date" oninput="validateDateInput(medical_date)" required>
                            <p class="input_error text-red-600"></p>
                            @error('date')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" id="addMedicalHistoryBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">ADD</button>
                </form>
            </div>
        </div>
        {{-- end --}}
    @endif

    @if (isset($cesno, $mainProfile))
        <!-- Modal for Resend Email -->
        <div id="resend_email_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
            <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
                <form id="resendEmailForm" action="{{ route('resend-email', ['cesno' => $cesno]) }}" method="POST" class="flex flex-col items-center">
                    @csrf
        
                    <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
                    <h2 class="text-2xl font-bold mb-4 text-center">Resend New Temporary Password For This Email</h2>
        
                    <div class="flex flex-col items-center mb-4">
                        <label for="email" class="mb-2">Email<sup>*</sup></label>
                        <input id="email" name="email" type="text" value="{{ $mainProfile->email }}" readonly required class="border rounded-lg px-3 py-2 w-64">
                    </div>
        
                    <button type="submit" id="resendEmailBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Resend</button>
                </form>
            </div>
        </div>
        {{-- end --}}
    @endif

    {{-- js script for personal data interaction and validation --}}
    <script src="{{ asset('js/form-interaction-validation.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- end --}}

    {{-- js script for location api integration --}}
    <script src="{{ asset('js/location-api-integration.js') }}"></script>
    {{-- end --}}

    {{-- js script for uploading image --}}
    <script src="{{ asset('js/profile-avatar.js') }}"></script>
    {{-- end --}}

    {{-- js script for adding medical history --}}
    <script src="{{ asset('js/medical-history.js') }}"></script>
    {{-- end --}}

    {{-- js script for adding medical history --}}
    <script src="{{ asset('js/resend-email.js') }}"></script>
    {{-- end --}}

    {{-- js script for adding languages --}}
    <script src="{{ asset('js/languages.js') }}"></script>
    {{-- end --}}

    {{-- js script for adding languages --}}
    <script src="{{ asset('js/change-role.js') }}"></script>
    {{-- end --}}

    {{-- js script for confirmation button --}}
    <script src="{{ asset('js/confirmation.js') }}"></script>
    {{-- end --}}

    {{-- js script for currentTime and date button --}}
    <script src="{{ asset('js/currentTime.js') }}"></script>
    {{-- end --}}

    {{-- js script for plantilla --}}
    <script src="{{ asset('js/plantilla/add_department_agency.js') }}"></script>
    {{-- end --}}

    {{-- toast for personal data success --}}
    @if (Session::has('message'))

        <script>
            toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.success("{{ Session::get('message') }}",'Success!',{timeOut:7000});
        </script>

    @endif

    @if (Session::has('info'))

        <script>
            toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.info("{{ Session::get('info') }}",'Success!',{timeOut:7000});
        </script>

    @endif

    @if (Session::has('error'))

        <script>
            toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.error("{{ Session::get('error') }}",'Error!',{timeOut:7000});
        </script>

    @endif
    {{-- end toast --}}

</body>

</html>
