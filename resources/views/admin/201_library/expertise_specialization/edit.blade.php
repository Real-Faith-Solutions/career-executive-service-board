@extends('layouts.app')
@section('title', 'Form Expertise Specialization - 201 Library')
@section('content')

<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('expertise-specialization.index') }}">Go Back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Expertise Specialization form
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('expertise-specialization.update', ['code'=>$code]) }}" method="POST" id="update_expertise_specialization_form" onsubmit="return checkErrorsBeforeSubmit(update_expertise_specialization_form)">
                @method('PUT')
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="Title">Expertise General</label>
                        <select name="expertise_general" required>
                            <option disabled selected>Select Expertise General</option>
                            @foreach ($profileLibTblExpertiseGen as $data)
                                @if ($data->GenExp_Code == $profileLibTblExpertiseMaster)
                                    <option value="{{ $data->GenExp_Code }}" selected>{{ $data->Title }}</option>
                                @else
                                    <option value="{{ $data->GenExp_Code }}">{{ $data->Title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Title">Title</label>
                        <input id="Title" name="Title" value="{{ $profileLibTblExpertiseSpec->Title }}" type="text" required>
                        @error('Title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateExpertiseSpecializationButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
