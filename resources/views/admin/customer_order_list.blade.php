@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <a href="{{url('admin/customer-orders/add')}}" class="btn btn-primary">+ New Order</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center mt-0">
                            <span class="">Customer Orders List</span>
                            <a href="{{url('admin/customer-orders/export')}}" class="btn btn-warning ml-auto m-0"><i class="fa fa-file-excel-o mr-2"></i>Export</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Order Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allArr as $obj)
                                <tr>
                                    <th scope="row">{{$obj['id']}}</th>
                                    <td>{{$obj['customer']['first_name'].' '.$obj['customer']['last_name'].' ('.$obj['customer']['company_name'].')'}}</td>
                                    <td>{{$obj['due_date']}}</td>
                                    <td>{{$obj['sub_total']}}</td>
                                    <td>
                                        @if($obj['status'] == 'PENDING') <h5 class="mb-0"><span class="badge badge-warning w-100">Pending</span></h5>@endif
                                        @if($obj['status'] == 'REJECT') <h5 class="mb-0"><span class="badge badge-danger w-100">Reject</span></h5>@endif
                                        @if($obj['status'] == 'DELIVERED') <h5 class="mb-0"><span class="badge badge-info w-100">Delivered</span></h5>@endif
                                        @if($obj['status'] == 'COMPLETE') <h5 class="mb-0"><span class="badge badge-success w-100">Complete</span></h5>@endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{url('admin/customer-orders/info/'.$obj['id'])}}" class="btn btn-sm btn-info mr-1"><i class="fa fa-eye"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="row justify-content-center mt-5">
                            {{ $allArr->appends($data)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
@endsection
