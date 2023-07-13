@extends('layouts.app')
@section('title', '201 profiling table')
@section('content')

    <section>
        <div class="grid grid-cols-3">
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
                            <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">

                                <a href="{{ env('APP_URL') }}admin/profile/views/{{ $item->cesno }}">
                                    <th scope="col" class="px-6 py-3">
                                        {{ $item->cesno }}
                                    </th>
                                    <td scope="col" class="px-6 py-3">
                                        {{ $item->lastname }}, {{ $item->firstname }} {{ $item->middlename }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ url('admin/profile/view', ['cesno' => $item->cesno]) }}" class="font-medium">View profile</a>
                                    </td>
                                </a>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-5">
                {{ $searched->links() }}
            </div>
        </div>

    </section>

@endsection
