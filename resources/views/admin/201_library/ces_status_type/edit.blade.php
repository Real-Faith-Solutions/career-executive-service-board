@extends('layouts.app')
@section('title', 'Update Form CES Status Type - 201 Library')
@section('content')

<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('ces-status-type-library.index') }}">Go Back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update CES Status Type form
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('ces-status-type-library.update', ['code'=>$code]) }}" method="POST" id="update_ces_status_type_form" onsubmit="return checkErrorsBeforeSubmit(update_ces_status_type_form)">
                @method('PUT')
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <input id="description" name="description" value="{{ $profileLibTblCesStatusType->description }}" type="text" required>
                        @error('description')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateCesStatusTypeButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection