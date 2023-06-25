@extends('layout')

@section('content')

<style>
    .nav-pills .nav-link {
        border: 1px solid #111;
        margin: 4px;
    }
</style>
<div class="container-fluid">
    <!-- Main content -->
    <section class="content">
        
        @if (str_contains(Request::url(),'rights-management/edit-user'))

        <script>setPageTitle('Edit User');</script>
        @else

        <script>setPageTitle('Users');</script>
        @endif

        <div class="container-fluid border border-primary py-3 pt-3">
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="user_details_tab" data-bs-toggle="tab" href="#user_details" role="tab" aria-controls="user_details" aria-selected="true">User Details</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border border-primary">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <!-- Start User Details -->
                        <div class="tab-pane fade show active" id="user_details" role="tabpanel" aria-labelledby="user_details_tab">
                            @if (str_contains(Request::url(),'rights-management/edit-user'))

                            <form class="user" id="user_details_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/user/update/{{ $user_id_data[0]->id }}`, `user_details_form`, `Update`, `None`, `None`, `user_details_form_submit`, `None`, `{{ env('APP_URL') }}admin/rights-management/user`)">
                            @else
                            
                            <form class="user" id="user_details_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/user/add`, `user_details_form`, `Add`, `None`, `None`, `user_details_form_submit`, `Yes`, `None`)">
                            @endif
                                @csrf
                                <div class="bg-primary">
                                    <h4 class="pl-3 py-2 text-warning font-weight-bold">USER DETAILS</h4>
                                </div>
                                <div class="container-fuild m-3">
                                    @if (str_contains(Request::url(),'rights-management/edit-user'))

                                    <div class="row">
                                        <img id="profile_picture" @if($user_id_data[0]->role == 'User') src="{{ ($user_id_data[0]->picture == '' ? asset('images/person.png') : asset('external-storage/Photos/201 Photos/'. $user_id_data[0]->picture)) }}" @else src="{{ ($user_id_data[0]->picture == '' ? asset('images/person.png') : asset('external-storage/Photos/Staff Photos/'. $user_id_data[0]->picture)) }}" @endif onerror="this.src = '{{ asset('images/person.png') }}'" class="mt-2 ml-3 mb-3 rounded bg-light float-right" height="190" width="190" alt="...">
                                    </div> 
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Lastname<span class="text-danger">*</span></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control w-100 mb-3" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->last_name }}" @else onchange="setUsername()" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Firstname<span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control w-100 mb-3" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->first_name }}" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Middlename<span class="text-danger">*</span></label>
                                            <input type="text" name="middle_name" class="form-control w-100 mb-3" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->middle_name }}" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Personal Mobile No. 1 ex. (<span class="badge-success">+63</span><span class="badge-primary">945</span>1234567)<span class="text-danger">*</span></label>
                                            <input type="text" id="contact_no" name="contact_no" class="form-control w-100 mb-3" maxlength="13" onchange="validateData(`mobile no. 1`,`{{ env('APP_URL') }}api/v1/user/validate-data`,this.value,`contact_no`)" placeholder="+639451234567" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->contact_no }}" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Official Email Address<span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control w-100 mb-3" onchange="validateData(`email`,`{{ env('APP_URL') }}api/v1/user/validate-data`,this.value,`email`)" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->email }}" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Employee ID<span class="text-danger">*</span></label>
                                            <input type="text" name="employee_id" class="form-control w-100 mb-3" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->employee_id }}" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Upload 2x2 Photo (Min. of 300x300 px)</label>
                                            <input class="p-1 mb-3" id="picture" name="picture" accept="image/png, image/jpeg" type="file" onclick="validateFileSize(`picture`, 2)"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Role<span class="text-danger">*</span></label>
                                            @if (str_contains(Request::url(),'rights-management/edit-user'))
                                            
                                            <input type="hidden" class="p-1 mb-3" name="role" value="{{ $user_id_data[0]->role }}">
                                            <select class="form-control w-100 mb-3" id="role" name="role" disabled>
                                                <option value="">Please Select</option>
                                                <option value="Super Administrator" {{ ($user_id_data[0]->role == 'Super Administrator') ? 'selected' : '' }}>Super Administrator</option>
                                                <option value="Administrator" {{ ($user_id_data[0]->role == 'Administrator') ? 'selected' : '' }}>Administrator</option>
                                                <option value="Power User" {{ ($user_id_data[0]->role == 'Power User') ? 'selected' : '' }}>Power User</option>
                                                <option value="Rank Officer" {{ ($user_id_data[0]->role == 'Rank Officer') ? 'selected' : '' }}>Rank Officer</option>
                                                <option value="CESB Operator" {{ ($user_id_data[0]->role == 'CESB Operator') ? 'selected' : '' }}>CESB Operator</option>
                                                <option value="Training Officer" {{ ($user_id_data[0]->role == 'Training Officer') ? 'selected' : '' }}>Training Officer</option>
                                                <option value="CESPES Operator" {{ ($user_id_data[0]->role == 'CESPES Operator') ? 'selected' : '' }}>CESPES Operator</option>
                                                <option value="Agency HR Operator" {{ ($user_id_data[0]->role == 'Agency HR Operator') ? 'selected' : '' }}>Agency HR Operator</option>
                                                <option value="User" {{ ($user_id_data[0]->role == 'User') ? 'selected' : '' }}>User</option>
                                            </select>
                                            @else

                                            <select class="form-control w-100 mb-3" id="role" name="role" onchange="getRoleNameNo(this.value)" required>
                                                <option value="">Please Select</option>
                                                <option value="Super Administrator">Super Administrator</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Power User">Power User</option>
                                                <option value="Rank Officer">Rank Officer</option>
                                                <option value="CESB Operator">CESB Operator</option>
                                                <option value="Training Officer">Training Officer</option>
                                                <option value="CESPES Operator">CESPES Operator</option>
                                                <option value="Agency HR Operator">Agency HR Operator</option>
                                                <option value="User">User</option>
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if (str_contains(Request::url(),'rights-management/edit-user'))

                                            <label class="form-label ml-2 mb-0">Role Name No.<span class="text-danger">*</span></label>
                                            <input type="number" id="role_name_no" name="role_name_no" class="form-control w-100 mb-3" value="{{ $user_id_data[0]->role_name_no }}" required readonly>
                                            @else

                                            <label class="form-label ml-2 mb-0">Role Name No.<span class="text-danger">*</span></label>
                                            <input type="number" id="role_name_no" name="role_name_no" class="form-control w-100 mb-3" required readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Username (Allowed characters: lowercase letter and number)<span class="text-danger">*</span></label>
                                            <input type="text" id="username" name="username" class="form-control w-100 mb-3" onchange="validateData(`username`,`{{ env('APP_URL') }}api/v1/user/validate-data`,this.value,`username`)" @if (str_contains(Request::url(),'rights-management/edit-user')) value="{{ $user_id_data[0]->username }}" @endif required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if (str_contains(Request::url(),'rights-management/edit-user'))

                                            <label class="form-label ml-2 mb-0">Reset Password<span class="text-danger">*</span></label>
                                            @else

                                            <label class="form-label ml-2 mb-0">Password<span class="text-danger">*</span></label>
                                            @endif
                                            <input type="password" name="password" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if (str_contains(Request::url(),'rights-management/edit-user'))

                                            <label class="form-label ml-2 mb-0">Reset Confirm Password<span class="text-danger">*</span></label>
                                            @else

                                            <label class="form-label ml-2 mb-0">Confirm Password<span class="text-danger">*</span></label>
                                            @endif
                                            <input type="password" name="password_confirmation" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Record Status<span class="text-danger">*</span></label>
                                            @if (str_contains(Request::url(),'rights-management/edit-user'))
                                            
                                            <select name="is_active" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Active" {{ ($user_id_data[0]->is_active == 'Active') ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ ($user_id_data[0]->is_active == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                                <option value="Retired" {{ ($user_id_data[0]->is_active == 'Retired') ? 'selected' : '' }}>Retired</option>
                                                <option value="Deceased" {{ ($user_id_data[0]->is_active == 'Deceased') ? 'selected' : '' }}>Deceased</option>
                                            </select>
                                            @else

                                            <select name="is_active" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Retired">Retired</option>
                                                <option value="Deceased">Deceased</option>
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col my-3">
                                            @if (str_contains(Request::url(),'rights-management/edit-user'))

                                            <input type="submit" id="user_details_form_submit" class="btn btn-secondary" value="Edit Record">
                                            <a href="{{ env('APP_URL') }}admin/rights-management/user"><input type="button" class="btn btn-primary" value="Go back to Add Record"></a>
                                            @else

                                            <input type="submit" id="user_details_form_submit" class="btn btn-primary" value="Add Record">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table table-responsive-lg table-hover">
                                        <thead class="text-white bg-secondary bg-gardient">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Personal Mobile No. 1</th>
                                                <th scope="col">Employee ID</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Role Name No.</th>
                                                <th scope="col">Record Status</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user_details_rights_tbody">
                                            @if(count($user_data) === 0)

                                            <tr>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            @endif
                                            @foreach($user_data as $user_data_item)

                                            <tr>
                                                <td>
                                                    <a class="badge badge-pill badge-secondary" href="{{ env('APP_URL') }}admin/rights-management/edit-user/{{ $user_data_item->id }}">Edit</a>
                                                    <!-- <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/user/delete/{{ $user_data_item->id }}`, `None`, `None`, `Yes`, `None`)">Delete</a> -->
                                                </td>
                                                <td nowrap="nowrap">{{ $user_data_item->first_name }} {{ $user_data_item->last_name }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->contact_no ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->employee_id ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->role ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->role_name_no ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->is_active ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->encoder ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($user_data_item->created_at)) ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ $user_data_item->last_updated_by ?? '-' }}</td>
                                                <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($user_data_item->updated_at)) ?? '-' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- End User Details -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
