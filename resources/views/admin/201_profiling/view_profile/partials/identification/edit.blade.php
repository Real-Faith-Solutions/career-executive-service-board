@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
              Update Form Identification
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('personal-data-identification.update', ['ctrlno'=>$identification->ctrlno]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="type">Type<sup>*</sup></label>
                        <select id="type" name="type" required>
                            <option disabled selected>Select type</option>
                            <option value="GSIS" {{ $identification->type == 'GSIS' ? 'selected' : '' }}>GSIS</option>
                            <option value="PAG-IBIG" {{ $identification->type == 'PAG-IBIG' ? 'selected' : '' }}>PAG-IBIG</option>
                        </select>
                        @error('type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="identification_id">Identification ID</label>
                        <input id="identification_id" name="identification_id" value="{{ $identification->id_number }}" type="text">
                        @error('identification_id')
                             <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection