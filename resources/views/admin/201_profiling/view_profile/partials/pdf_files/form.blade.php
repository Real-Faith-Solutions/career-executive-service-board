@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                PDF File
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('show-pdf-files.store', ['cesno'=>$cesno]) }}" enctype="multipart/form-data" method="POST">
                @csrf
        
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="pdfFile">PDF File<sup>*</sup></label>
                        <input type="file" id="pdfFile" name="pdfFile" required>
                        @error('pdfFile')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remarks">Remark's<sup>*</sup></label>
                        <input type="text" id="remarks" name="remarks" required>
                        @error('remarks')
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


