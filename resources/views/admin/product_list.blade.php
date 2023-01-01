@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <a href="{{url('admin/products/add')}}" class="btn btn-primary">+ New Product</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center mt-0">
                            <span class="">Products List</span>
                            <a href="{{url('admin/products/export')}}" class="btn btn-warning ml-auto m-0"><i class="fa fa-file-excel-o mr-2"></i>Export</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Available QTY</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allArr as $obj)
                                <tr>
                                    <th scope="row">{{$obj['id']}}</th>
                                    <td>{{$obj['name']}}</td>
                                    <td>{{$obj['unit_price']}}</td>
                                    <td>{{$obj['qty']}}</td>
                                    <td class="text-right">
                                        <a href="{{url('admin/products/info/'.$obj['id'])}}" class="btn btn-sm btn-info mr-1"><i class="fa fa-eye"></i></a>
                                        <a href="{{url('admin/products/delete/'.$obj['id'])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
