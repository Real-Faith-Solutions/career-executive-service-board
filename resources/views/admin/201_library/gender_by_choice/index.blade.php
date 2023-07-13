@extends('layouts.app')
@section('title', 'Gender By Choice - 201 Library')
@section('content')

<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('gender-by-choice.create') }}">Add Gender by choice</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    No.
                </th>
                <th class="px-6 py-3" scope="col">
                    Name
                </th>
                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @php
                $i = 1;
            @endphp
            @foreach ($datas as $data)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $i++ }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $data->name }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <a class="mx-1 font-medium text-blue-600 hover:underline" href="#">Update</a>
                        <a class="mx-1 font-medium text-red-600 hover:underline" href="#">Delete</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="m-5">
        {{ $datas->links() }}
    </div>
</div>

@endsection
