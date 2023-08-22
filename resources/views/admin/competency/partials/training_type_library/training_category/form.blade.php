@extends('layouts.app')
@section('title', 'Training Category Form')
@section('sub', 'Training Category Form')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('training-category.index') }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Training Category
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="training_category">Training Category<sup>*</sup></label>
                        <input type="text" id="training_category" name="training_category" oninput="validateInput(training_category, 6, 'letters')" onkeypress="validateInput(training_category, 6, 'letters')" onblur="checkErrorMessage(training_category)" required>
                        <p class="input_error text-red-600"></p>
                        @error('training_category')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
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

@endsection