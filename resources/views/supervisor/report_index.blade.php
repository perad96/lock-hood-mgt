@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content" id="reportViewContent">
        <div class="row">

            <div class="col-md-4 mb-3">
                <a href="{{url('supervisor/reports/view-task')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Employee Task Reports
                    </div>
                </a>
            </div>

{{--            <div class="col-md-4 mb-3">--}}
{{--                <a href="{{url('supervisor/reports/view-employee-work-hours')}}">--}}
{{--                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">--}}
{{--                        Employee Work Hours--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="col-md-4 mb-3">
                <a href="{{url('supervisor/reports/view-most-issued-task')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Most Issued Tasks
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection

@section('js')
@endsection
