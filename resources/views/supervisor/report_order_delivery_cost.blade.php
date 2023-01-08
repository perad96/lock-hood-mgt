@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-md-4">
                <a href="{{url('supervisor/reports/all')}}" class="btn btn-danger">All Reports</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center mt-0">
                            <span class="">Order Delivery Cost</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="get" action="{{url('supervisor/reports/view-order-delivery-cost')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <input name="month" value="{{request()->get('month')}}" type="month" class="form-control @error('month')is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-3">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-secondary">Search</button>
                                    </div>
                                </div>
                                @if(count($allArr) > 0)
                                    <div class="col-md-7 text-right">
                                        <div class="form-group mt-3">
                                            <label>&nbsp;</label>
                                            <a href="{{url('supervisor/reports/export-order-delivery-cost?month=').request()->get('month')}}" class="btn btn-warning"><i class="fa fa-file-excel-o mr-2"></i>Export</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Orders Count</th>
                                <th scope="col">Delivery Fee Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allArr as $obj)
                                <tr>
                                    <th scope="row">{{$obj['date']}}</th>
                                    <td>{{$obj['order_count']}}</td>
                                    <td>{{$obj['delivery_fee_sum']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@endsection
