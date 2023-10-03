@extends('layouts.app')
@section('title', 'Classification Basis - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-class-basis.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Classification Basis
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-class-basis.store') }}" method="POST">
                @csrf

                <input type="hidden" name="encoder" value="{{ $userName }}" readonly>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="basis">Basis<sup>*</span></label>
                        <input id="basis" name="basis" type="text" value="{{ old('basis') }}" required>
                        @error('basis')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title">Title<sup>*</span></label>
                        <textarea name="title" id="title" cols="30" rows="10" required>{{ old('title') }}</textarea>
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="classdate">Class Date<sup>*</span></label>
                        <input id="classdate" name="classdate" type="date" value="{{ old('classdate') }}" required>
                        @error('classdate')
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