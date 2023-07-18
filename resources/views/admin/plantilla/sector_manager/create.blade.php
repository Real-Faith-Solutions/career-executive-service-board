@extends('layouts.app')
@section('title', 'Sector Manager')
@section('sub', 'Sector Manager')
@section('content')
@include('admin.plantilla.header')

<div class="my-5 flex justify-end gap-4">
    <a class="btn btn-primary" href="{{ route('sector-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Sector Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('sector-manager.store') }}" method="POST">
                @csrf

                <input type="hidden" name="encoder" value="{{ Auth::user()->last_name}} {{ Auth::user()->first_name}} {{ Auth::user()->middle_name}}" readonly>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title">Sector name<sup>*</span></label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description<sup>*</span></label>
                            <textarea name="description" id="description" placeholder="Write your thoughts here..." required>{{ old('description') }}</textarea>
                        @error('description')
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
