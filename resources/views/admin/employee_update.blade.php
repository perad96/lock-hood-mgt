@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Update Employee Info</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('employee-update')}}">
                            @csrf
                            <input name="id" value="{{$obj['id']}}" type="hidden">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select onchange="onchangedSection()" id="selectSection" name="section" class="form-control @error('section')is-invalid @enderror">
                                            <option value="">- Select Section -</option>
                                            @foreach($sectionsArr as $section)
                                                <option @if($section['id'] == old('section')) selected @elseif($section['id'] == $obj['section_id']) selected @endif value="{{$section['id']}}">{{$section['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('section')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Role</label>
                                        <select id="selectJobRole" name="job_role" class="form-control @error('job_role')is-invalid @enderror">
                                            <option value="">- Select Job Role -</option>
                                            @foreach($jobRolesArr as $jobRole)
                                                <option @if($jobRole['id'] == old('job_role')) selected @elseif($jobRole['id'] == $obj['job_role_id']) selected @endif value="{{$jobRole['id']}}">{{$jobRole['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('job_role')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" value="{{(old('first_name') !== null) ? old('first_name') : $obj['first_name'] }}" type="text" class="form-control @error('first_name')is-invalid @enderror">
                                        @error('first_name')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" value="{{(old('last_name') !== null) ? old('last_name') : $obj['last_name'] }}" type="text" class="form-control @error('last_name')is-invalid @enderror">
                                        @error('last_name')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input name="date_of_birth" value="{{(old('date_of_birth') !== null) ? old('date_of_birth') : $obj['date_of_birth'] }}" type="date" class="form-control @error('date_of_birth')is-invalid @enderror">
                                        @error('date_of_birth')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control @error('gender')is-invalid @enderror">
                                            <option value="">- Select Gender -</option>
                                            @foreach($gendersArr as $gender)
                                                <option @if($gender == old('gender')) selected @elseif($gender == $obj['gender']) selected @endif value="{{$gender}}">{{$gender}}</option>
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
                                        <input name="email" value="{{(old('email') !== null) ? old('email') : $obj['email'] }}" type="text" class="form-control @error('email')is-invalid @enderror">
                                        @error('email')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" value="{{(old('phone') !== null) ? old('phone') : $obj['phone'] }}" type="tel" class="form-control @error('phone')is-invalid @enderror">
                                        @error('phone')<span class="small text-danger">{{ $message }}</span>@enderror
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
    </script>
@endsection
