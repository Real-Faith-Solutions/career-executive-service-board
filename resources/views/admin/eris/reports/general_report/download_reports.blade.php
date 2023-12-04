@extends('layouts.app')
@section('title', 'Eris General Report')
@section('sub', 'Eris Report')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap uppercase text-blue-500">ERIS - DOWNLOAD GENERAL REPORTS</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('general-report.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

    <section>

        <div class="flex flex-wrap flex-col items-center mx-auto p-4">
            @foreach ($downloadLinks as $link)
                <a class="btn btn-primary mb-2" href="{{ $link['url'] }}" target='_blank'>{{ $link['label'] }}</a>
            @endforeach
        </div>

    </section>

@endsection
