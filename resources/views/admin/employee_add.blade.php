@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Add New Employee</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('employee-add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select onchange="onchangedSection()" id="selectSection" name="section" class="form-control @error('section')is-invalid @enderror">
                                            <option value="">- Select Section -</option>
                                            @foreach($sectionsArr as $section)
                                                <option @if($section['id'] == old('section')) selected @endif value="{{$section['id']}}">{{$section['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('section')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Role</label>
                                        <select id="selectJobRole" name="job_role" disabled class="form-control @error('job_role')is-invalid @enderror">
                                        </select>
                                        @error('job_role')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" value="{{old('first_name')}}" type="text" class="form-control @error('first_name')is-invalid @enderror">
                                        @error('first_name')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" value="{{old('last_name')}}" type="text" class="form-control @error('last_name')is-invalid @enderror">
                                        @error('last_name')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input name="date_of_birth" value="{{old('date_of_birth')}}" type="date" class="form-control @error('date_of_birth')is-invalid @enderror">
                                        @error('date_of_birth')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control @error('gender')is-invalid @enderror">
                                            <option value="">- Select Gender -</option>
                                            @foreach($gendersArr as $gender)
                                                <option @if($gender == old('gender')) selected @endif value="{{$gender}}">{{$gender}}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" value="{{old('email')}}" type="text" class="form-control @error('email')is-invalid @enderror">
                                        @error('email')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" value="{{old('phone')}}" type="tel" class="form-control @error('phone')is-invalid @enderror">
                                        @error('phone')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input onclick="onClickCheckUserAccount()" type="checkbox" class="custom-control-input" id="checkUserAccount" name="checkUserAccount">
                                <label class="custom-control-label" for="checkUserAccount">Create user account for employee</label>
                            </div>

                            <div id="divUserInfo">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control @error('role')is-invalid @enderror">
                                                <option value="">- Select Role -</option>
                                                @foreach($roleArr as $role)
                                                    @if(old('role') == $role)
                                                        <option selected value="{{$role}}">{{$role}}</option>
                                                    @else
                                                        <option value="{{$role}}">{{$role}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('role')<span class="small text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input name="password" type="password" class="form-control @error('password')is-invalid @enderror">
                                            @error('password')<span class="small text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Re-Enter Password</label>
                                            <input name="password_confirmation" type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#divUserInfo').hide();

        function onchangedSection() {
            $('#selectJobRole').text('');
            let html = '';

            const sectionId = $('#selectSection').val();

            $.ajax({
                url: BASE + '/util/get-job-roles-by-section/' + sectionId,
                method: "get",
            }).done(function (resp) {

                html += `<option value="">- Select Job Role -</option>`;
                for (let i = 0; i < resp.length; i++) {
                    html += `<option value="${resp[i]['id']}">${resp[i]['name']}</option>`;
                }
                $('#selectJobRole').append(html);
                $('#selectJobRole').prop('disabled', false);
            });
        }


        function onClickCheckUserAccount(){
            const isChecked = $('#checkUserAccount').is(':checked');

            if(isChecked){
                $('#divUserInfo').show();
            }else{
                $('#divUserInfo').hide();
            }
        }
    </script>
@endsection
