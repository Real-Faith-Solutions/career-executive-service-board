@extends('layouts.app')
@section('title', 'DBM Position - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-dbm-position-title.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                DBM Position
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-dbm-position-title.store') }}" method="POST">
                @csrf

                <input type="hidden" name="encoder" value="{{ $userName }}" readonly>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="poslevel_code">Position Level<sup>*</span></label>
                        <select id="poslevel_code" name="poslevel_code" required>
                            @foreach ($planPositionLevelLibrary as $data)
                            <option value="{{ $data->poslevel_code }}">
                                {{ $data->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('poslevel_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dbm_title">Title<sup>*</span></label>
                        <input id="dbm_title" name="dbm_title" type="text" value="{{ old('dbm_title') }}" required>
                        @error('dbm_title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sg">Salary Grade Level<sup>*</span></label>
                        <input id="sg" name="sg" type="number" value="{{ old('sg') }}" required min="20" max="30">
                        @error('sg')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="func_title">Func Title<sup>*</span></label>
                        <input id="func_title" name="func_title" type="text" value="{{ old('func_title') }}" required>
                        @error('func_title')
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