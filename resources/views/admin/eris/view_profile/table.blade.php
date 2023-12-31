@extends('layouts.app')
@section('title', 'ERIS')
@section('content')

    <div class="text-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-700">
        Erad Recruitment Information System - (ERIS)
    </div>

    <section>
        <div class="flex justify-between mt-10">
            <div class="grid lg:grid-cols-2">
                @include('components.search')
            </div>

            <div class="flex items-center">
                <a href="{{ route('eris.create') }}" class="btn btn-primary" >Add New Profile</a>
            </div>
        </div>

        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            AC No.
                        </th>

                        <th scope="col" class="px-6 py-3">
                            CESNO.
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
                    @foreach ($erisTblMain as $erisTblMains)
                        <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">
                            <th scope="col" class="px-6 py-3">
                                {{ $erisTblMains->acno }}
                            </th>

                            <th scope="col" class="px-6 py-3">
                                {{ $erisTblMains->cesno }}
                            </th>

                            <td scope="col" class="px-6 py-3">
                                {{ 
                                    $erisTblMains->lastname.', '.
                                    $erisTblMains->firstname.', '.
                                    $erisTblMains->middlename
                                }} 
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('eris.edit', ['acno'=>$erisTblMains->acno]) }}" class="font-medium">View profile</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="my-5">
                {{ $erisTblMain->links() }}
            </div>
        </div>
    </section>
@endsection
