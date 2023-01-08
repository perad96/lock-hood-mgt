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
                <a href="{{url('admin/reports/view-top-selling-product')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Top Selling Products
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-most-wanted-material')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Most Wanted Materials
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-order-delivery-cost')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Order Delivery Cost
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-employee-work-hours')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Employee Work Hours
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-most-issued-task')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Most Issued Tasks
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{url('admin/reports/view-top-customers')}}">
                    <div class="text-light shadow card card-body text-center w-100 font-weight-bold">
                        Top Customers
                    </div>
                </a>
            </div>



        </div>
    </div>
@endsection

@section('js')
@endsection
