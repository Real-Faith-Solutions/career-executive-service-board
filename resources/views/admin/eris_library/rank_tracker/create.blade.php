@extends('layouts.app')
@section('title', 'Rank Tracker - Eris Library')
@section('content')

<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('rank-tracker-library.index') }}">Go Back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Rank Tracker form
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-0 md:grid-cols-1 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <input id="description" name="description" type="text" required>
                        @error('description')
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