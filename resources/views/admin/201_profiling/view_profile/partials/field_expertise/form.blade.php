@extends('layouts.app')
@section('title', 'Field Expertise')
@section('sub', 'Field Expertise')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('expertise.index', ['cesno' => $cesno]) }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Field Expertise
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('expertise.store', ['cesno'=>$cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="SpeExp_Code">Expertise / Field of Specialization<sup>*</span></label>
                        <select id="SpeExp_Code" name="specialization_code" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach($profileLibTblExpertiseSpec as $profileLibTblExpertiseSpecs)
                                <option value="{{ $profileLibTblExpertiseSpecs->SpeExp_Code }}">
                                    {{ $profileLibTblExpertiseSpecs->Title }}
                                </option>
                            @endforeach
                        </select>
                        @error('specialization_code')
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