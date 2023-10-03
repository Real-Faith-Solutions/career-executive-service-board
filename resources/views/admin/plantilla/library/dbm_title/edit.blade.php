@extends('layouts.app')
@section('title', 'DBM Position Title - Edit')
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
                DBM Position Title
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-dbm-position-title.update', $datas->pos_code) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="poslevel_code">Position Level<sup>*</span></label>
                        <select id="poslevel_code" name="poslevel_code" required>
                            @foreach ($planPositionLevelLibrary as $data)
                            <option value="{{ $data->poslevel_code }}" {{ $data->poslevel_code === $datas->poslevel_code
                                ? 'selected' : ''}}>
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
                        <input id="dbm_title" name="dbm_title" type="text" value="{{ $datas->dbm_title }}" required>
                        @error('dbm_title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sg">Salary Grade Level<sup>*</span></label>
                        <input id="sg" name="sg" type="number" value="{{ $datas->sg }}" required min="20" max="30">
                        @error('sg')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="func_title">Func Title<sup>*</span></label>
                        <input id="func_title" name="func_title" type="text" value="{{ $datas->func_title }}" required>
                        @error('func_title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between">
                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($datas->lastupd_dt)->format('m/d/Y \a\t g:iA') }}
                    </h1>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection