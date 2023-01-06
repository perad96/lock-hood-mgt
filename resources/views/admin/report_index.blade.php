@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content" id="reportViewContent">
        <div class="row">

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-income')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Monthly Income
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-task')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Employee Task Reports
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/system-users/add')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Employee Progress
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/system-users/add')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Sales
                    </div>
                </a>
            </div>



        </div>
    </div>
@endsection

@section('js')
@endsection
