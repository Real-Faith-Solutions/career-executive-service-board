@extends('layouts.app')
@section('title', 'Ces Training')
@section('sub', 'Ces Training Participant')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-between mt-7">
    <div class="flex items-center">
        <form action="{{ route('training-session.addParticipant', ['sessionId'=>$sessionId]) }}" method="GET">
            <div class="flex gap-4">
                <input type="text" name="search" id="search" list="searchResults" placeholder="Search..." value="{{ $search }}">
                <datalist id="searchResults">
                    @foreach($personalData as $personalDatas)
                        <option value="{{ $personalDatas->cesno }}">{{ $personalDatas->lastname }} {{ $personalDatas->firstname }} {{ $personalDatas->middlename }}<option>
                    @endforeach
                </datalist>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="flex justify-center items-center">
        <a href="{{ route('training-session.participantList', ['sessionId'=>$sessionId]) }}" class="btn btn-primary" >Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                {{ $trainingSessionDescription }} Form Training Participant 
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-session.storeParticipant', ['sessionId'=>$sessionId]) }}" method="POST" id="participant_training_form" onsubmit="return checkErrorsBeforeSubmit(participant_training_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="cesno">CESNO<sup>*</sup></label>
                        <input type="text" id="cesno" name="cesno" value="{{ $personalDataSearchResult->cesno ?? '' }}" readonly>
                        @error('cesno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="name">Name<sup>*</sup></label>
                        <input type="text" id="name" name="name" value="{{ $personalDataSearchResult->lastname ?? '' }} {{ $personalDataSearchResult->firstname ?? '' }} {{ $personalDataSearchResult->middlename ?? '' }} {{ $personalDataSearchResult->name_extension ?? '' }}"  readonly>
                        @error('training_category')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ces_status">CES Status<sup>*</sup></label>
                        <input type="text" name="ces_status" value="{{ $description }}"  readonly>
                        @error('ces_status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="status">Status<sup>*</sup></label>
                        <select name="status" id="status">
                            <option disabled selected>Select Status</option>
                            <option value="Completed">Completed</option>
                            <option value="Incomplete">Incomplete</option>
                            <option value="Reserved">Reserved</option>
                            <option value="Pending">Pending</option>
                            <option value="No Show">No Show</option>
                        </select>
                        @error('status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_of_hours">No. of Training Hours<sup>*</sup></label>
                        <input type="number" id="no_of_hours" name="no_of_hours" oninput="validateInput(no_of_hours, 1, 'numbers')" onkeypress="validateInput(no_of_hours, 1, 'numbers')" onblur="checkErrorMessage(no_of_hours)" required>
                        <p class="input_error text-red-600"></p>
                        @error('no_of_hours')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="payment">Payment<sup>*</sup></label>
                        <select id="payment" name="payment" required>
                            <option disabled selected>Select Payment</option>
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">UnPaid</option>
                            <option value="Partial">Partial</option>
                        </select>
                        @error('payment')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div >
                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</sup></label>
                        <textarea name="remarks" id="remarks" cols="10" rows="3"></textarea>
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