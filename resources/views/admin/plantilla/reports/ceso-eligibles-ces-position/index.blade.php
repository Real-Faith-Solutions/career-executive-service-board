@extends('layouts.app')
@section('content')
@section('title', 'List of CESOs and CES Eligibles in CES Positions')
<h1 class="text-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 mb-5">
    List of CESOs and CES Eligibles in CES Positions
</h1>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">NATIONAL GOVERNMENT AGENCIES</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($motherDepartmentAgency as $data)
            <tr>

                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    <a class="text-sm leading-5 text-gray-900 hover:text-blue-500"
                        href="{{ route('ceso-eligibles-ces-position.pdf', $data->deptid) }}" target="_blank"
                        title="Generate PDF">
                        {{ $data->title }}
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection