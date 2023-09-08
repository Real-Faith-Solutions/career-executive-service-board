@extends('layouts.app')
@section('title', 'Training Engagement')
@section('sub', 'Training Engagement')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('resource-speaker.index') }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Session ID
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Category
                </th>

                <th scope="col" class="px-6 py-3">
                    From
                </th>

                <th scope="col" class="px-6 py-3">
                    To
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainingEnagagement as $trainingEnagagements)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingEnagagements->sessionid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingEnagagements->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingEnagagements->category }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingEnagagements->from_dt }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingEnagagements->to_dt }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="m-5">
    {{ $trainingEnagagement->links() }}
</div>

@endsection