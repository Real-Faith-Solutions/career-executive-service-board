@extends('layouts.app')
@section('title', 'Update Language Dialect')
@section('sub', 'Update Language Dialect')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <form action="{{ route('language.index', ['cesno'=>$cesno]) }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-primary" id='add-edit-languages-btn'>Back</button>
    </form>
</div>

<div class="relative overflow-x-auto sm:rounded-lg shadow-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Language Dialect
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('language.update', ['cesno'=>$cesno, 'languageCode'=>$languageId]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="language_code">Language Dialect<sup>*</sup></label>
                        <select id="language_code" name="language_code" required>
                            <option disabled selected>Select language</option>
                            @foreach($profileLibTblLanguageRef as $profileLibTblLanguageRefs)
                                @if ($profileLibTblLanguageRefs->code == $languageId)
                                    <option value="{{ $profileLibTblLanguageRefs->code}}" selected>
                                        {{ $profileLibTblLanguageRefs->title }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblLanguageRefs->code}}">
                                        {{ $profileLibTblLanguageRefs->title }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('language_code')
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