@extends('layouts.app')
@section('title', 'General Reports')
@section('sub', 'General Reports')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">201 PROFILE - STATISTICAL REPORTS</span>
        </a>

        <div class="flex justify-end">
            <a href="#" target='_blank' class="btn btn-primary">Generate PDF Report</a>
        </div>
    </div>
</nav>

    <section>

        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            sample1
                        </th>
                        <th scope="col" class="px-6 py-3">
                            sample2
                        </th>

                        
                    </tr>
                </thead>
                <tbody>
                        
                </tbody>
            </table>
        </div>

    </section>

@endsection
