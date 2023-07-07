@extends('layouts.app')
@section('title', 'Family profile form')
@section('content')

{{-- mother details --}}
<form action="{{ route('family-profile-mother.store', ['cesno' => $cesno]) }}" method="POST">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="mother_last_name">Mother Last Name<sup>*</sup></label>
            <input type="text" id="mother_last_name" name="mother_last_name" required>

            @error('mother_last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="mother_first_name">Mother First Name<sup>*</span></label>
            <input type="text" name="mother_first_name" id="mother_first_name" required>

            @error('mother_first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mother_middle_name">Mother Middle Name</label>
            <input type="text" name="mother_middle_name" id="mother_middle_name">

            @error('mother_middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

    </div>

    <div><button type="submit" class="btn btn-primary">Save</button></div>
</form>

@endsection