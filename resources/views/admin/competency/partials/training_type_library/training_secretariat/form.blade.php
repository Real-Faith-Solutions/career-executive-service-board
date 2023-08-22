@extends('layouts.app')
@section('title', 'Training Secretariat Form')
@section('sub', 'Training Secretariat Form')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('training-secretariat.index') }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Training Secretariat
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-secretariat.store') }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="training_secretariat">Training Category<sup>*</sup></label>
                        <input type="text" id="training_secretariat" name="training_secretariat" oninput="validateInput(training_secretariat, 6, 'letters')" onkeypress="validateInput(training_secretariat, 6, 'letters')" onblur="checkErrorMessage(training_secretariat)" required>
                        <p class="input_error text-red-600"></p>
                        @error('training_secretariat')
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