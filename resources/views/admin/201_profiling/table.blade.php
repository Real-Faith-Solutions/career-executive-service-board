@extends('layouts.app')
@section('title', 'table')
@section('content')

    <section>
        <div class="grid grid-cols-4">
            @include('components.search')
        </div>

        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Ces No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($searched) === 0)

                        <tr>
                            <th class="text-red-500" colspan="3">
                                <h1 class="text-center">No result found</h1>
                                <div class="flex justify-center">
                                    <a class="btn btn-primary" href="{{ env('APP_URL') }}admin/profile/add">Add profile instead</a>
                                </div>
                            </th>
                        </tr>
                    @else
                        @foreach ($searched as $item)
                            <tr class="border-b bg-white">
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                    <a href="{{ env('APP_URL') }}admin/profile/views/{{ $item->cesno }}">{{ $item->cesno }}</a>
                                </th>
                                <td class="px-6 py-4">
                                    <a href="{{ env('APP_URL') }}admin/profile/views/{{ $item->cesno }}">{{ $item->lastname }}, {{ $item->firstname }} {{ $item->middlename }}</a>
                                    <a class="badge badge-pill badge-danger float-right" style="display:none">Delete</a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 hover:underline">View profile</a>
                            </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </section>

@endsection
