@extends('layouts.app')
@section('title', 'Edit Family Profile')
@section('sub', 'Edit Family Profile')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('family-profile.show', ['cesno' => $cesno]) }}">Go back</a>
</div>
<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form Father Record
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('family-profile-father.updateFatherRecord', ['ctrlno'=>$father->ctrlno]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="father_last_name">Last name<sup>*</sup></label>
                        <input type="text" id="father_last_name" name="father_last_name" value="{{ $father->father_last_name }}" oninput="validateInput(father_last_name, 2, 'letters')" onkeypress="validateInput(father_last_name, 2, 'letters')" onblur="checkErrorMessage(father_last_name)" required>
                        <p class="input_error text-red-600"></p>
                        @error('father_last_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="father_first_name">First name<sup>*</span></label>
                        <input type="text" id="father_first_name" name="father_first_name" value="{{ $father->father_first_name }}" oninput="validateInput(father_first_name, 2, 'letters')" onkeypress="validateInput(father_first_name, 2, 'letters')" onblur="checkErrorMessage(father_first_name)" required>
                        <p class="input_error text-red-600"></p>
                        @error('father_first_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="father_middle_name">Middle name</label>
                        <input type="text" id="father_middle_name" name="father_middle_name" value="{{ $father->father_middle_name }}" oninput="validateInput(father_middle_name, 0, 'letters')" onkeypress="validateInput(father_middle_name, 0, 'letters')" onblur="checkErrorMessage(father_middle_name)">
                        <p class="input_error text-red-600"></p>
                        @error('father_middle_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="father_name_extension">Name Extension</label>
                        <input id="father_name_extension" list="name_extension_choices" name="father_name_extension" value="{{ $father->name_extension }}" type="search">
                        <datalist id="name_extension_choices">
                            @foreach ($nameExtensions as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>
            
                <div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">
                            Update Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection