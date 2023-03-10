@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Update Customer Info</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('customer-update')}}">
                            @csrf
                            <input name="id" value="{{$obj['id']}}" type="hidden">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input name="company_name" value="{{(old('company_name') !== null) ? old('company_name') : $obj['company_name'] }}" type="text" class="form-control @error('company_name')is-invalid @enderror">
                                        @error('company_name')<span class="small text-danger">{{ $message }}</span>@enderror
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
                                        <label>Phone</label>
                                        <input name="phone" value="{{(old('phone') !== null) ? old('phone') : $obj['phone'] }}" type="tel" class="form-control @error('phone')is-invalid @enderror">
                                        @error('phone')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input name="mobile" value="{{(old('mobile') !== null) ? old('mobile') : $obj['mobile'] }}" type="tel" class="form-control @error('mobile')is-invalid @enderror">
                                        @error('mobile')<span class="small text-danger">{{ $message }}</span>@enderror
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
@endsection
