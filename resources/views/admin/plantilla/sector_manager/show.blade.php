@extends('layouts.app')
@section('title', 'Sector Manager')
@section('sub', 'Sector Manager')
@section('content')
@include('admin.plantilla.header')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Plantilla</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li>
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Sector</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li>
            <a href="#" class="text-blue-500">Edit</a>
        </li>

    </ol>
</nav>

<div class="flex justify-end">
    <a href="{{ route('sector-manager.index') }}" class="btn btn-primary">Go Back</a>
</div>

<div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Sector Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-sector.update', $datas->sectorid) }}" method="POST"
                    enctype="multipart/form-data" id="updateSector"
                    onsubmit="return checkErrorsBeforeSubmit(updateSector)">
                    @csrf
                    @method('put')
                    <input type="hidden" name="encoder"
                        value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"
                        readonly>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="title">Sector name<sup>*</span></label>
                            <input id="title" name="title" type="text" value="{{ $datas->title }}" required>
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Description<sup>*</span></label>
                            <textarea name="description" id="description" placeholder="Write your thoughts here..."
                                required>{{ $datas->description }}</textarea>
                            @error('description')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <h1 class="text-slate-400 text-sm font-semibold">
                            Last update at {{ \Carbon\Carbon::parse($datas->lastupd_date)->format('m/d/Y \a\t g:iA') }}
                        </h1>
                        <div>
                            <button type="button" id="btnEdit" class="btn btn-primary">
                                Edit Record
                            </button>
                            <button type="button" class="btn btn-primary hidden" id="btnSubmit"
                                onclick="openConfirmationDialog(this, 'Confirm changes', 'Are you sure you want to update this record?')">
                                Save Changes
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection