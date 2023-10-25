@extends('layouts.app')
@section('title', 'Form Case Status - 201 Library')
@section('content')

<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('case-status-library.index') }}">Go Back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Case Status form
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('case-status-library.store') }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="TITLE">Description</label>
                        <input id="TITLE" name="TITLE" type="text" required>
                        @error('TITLE')
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
@endsection