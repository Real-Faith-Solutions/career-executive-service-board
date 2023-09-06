@extends('layouts.app')
@section('title', 'Ces Training')
@section('sub', 'Ces Training')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('ces-training.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form CES Training
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="" method="POST" id="update_ces_trainings_form" onsubmit="return checkErrorsBeforeSubmit(update_ces_trainings_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="sessionid">Training Session<sup>*</sup></label>
                        <select name="sessionid" id="sessionid">
                            <option disabled selected>Select Training Session</option>
                            @foreach ($trainingSession as $trainingSessions)
                                @if ($trainingSessions->sessionid == $trainingParticipants->sessionid )
                                    <option value="{{ $trainingSessions->sessionid }}" selected>{{ $trainingSessions->title }}</option>
                                @else
                                    <option value="{{ $trainingSessions->sessionid }}" >{{ $trainingSessions->title }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('sessionid')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="cesno">CESNO<sup>*</sup></label>
                        <input type="text" id="cesno" name="cesno" value="{{ $personalData->cesno }}" readonly>
                        @error('cesno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="name">Name<sup>*</sup></label>
                        <input type="text" id="name" name="name" value="{{ $personalData->lastname. ', '.$personalData->firstname. ', '.$personalData->name_extension. ', '.$personalData->middleinitial }}" readonly>
                        @error('training_category')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ces_status">CES Status<sup>*</sup></label>
                        <input type="text" name="ces_status" value="{{ $latestCesStatus }}" readonly>
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
                            <option value="Completed" {{ $trainingParticipants->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Incomplete" {{ $trainingParticipants->status == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                            <option value="Reserved" {{ $trainingParticipants->status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                            <option value="Pending" {{ $trainingParticipants->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="No Show" {{ $trainingParticipants->status == 'No Show' ? 'selected' : '' }}>No Show</option>
                        </select>
                        @error('status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_of_hours">No. of Training Hours<sup>*</sup></label>
                        <input type="number" id="update_no_of_hours" name="no_of_hours" oninput="validateInput(update_no_of_hours, 1, 'numbers')" onkeypress="validateInput(update_no_of_hours, 1, 'numbers')" onblur="checkErrorMessage(update_no_of_hours)" value="{{ $trainingParticipants->no_hours }}" required>
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
                            <option value="Paid" {{ $trainingParticipants->payment == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Unpaid" {{ $trainingParticipants->payment == 'Unpaid' ? 'selected' : '' }}>UnPaid</option>
                            <option value="Partial" {{ $trainingParticipants->payment == 'Partial' ? 'selected' : '' }}>Partial</option>
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
                        <textarea name="remarks" id="remarks" cols="10" rows="3">{{ $trainingParticipants->remarks }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateTrainingParticipantsButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection