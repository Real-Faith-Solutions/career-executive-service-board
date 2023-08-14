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
                    @foreach ($competencyData as $competencyDatas)
                        <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">

                            <th scope="col" class="px-6 py-3">
                                {{ $competencyDatas->cesno }}        
                            </th>

                            <td scope="col" class="px-6 py-3">
                                {{ $competencyDatas->lastname }}, {{ $competencyDatas->firstname }} {{ $competencyDatas->middlename }}. {{ $competencyDatas->name_extension }} 
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('competency-view-profile.updateOrCreate', ['cesno'=>$competencyDatas->cesno]) }}" class="font-medium">View profile</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-5">
                {{ $competencyData->links() }}
            </div>
        </div>

    </section>

@endsection
