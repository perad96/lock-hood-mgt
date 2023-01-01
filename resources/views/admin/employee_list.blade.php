@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <a href="{{url('admin/employees/add')}}" class="btn btn-primary">+ New Employee</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center mt-0">
                            <span class="">Employees List</span>
                            <a href="{{url('admin/employees/export')}}" class="btn btn-warning ml-auto m-0"><i class="fa fa-file-excel-o mr-2"></i>Export</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Section</th>
                                <th scope="col">Job Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allArr as $obj)
                                <tr>
                                    <th scope="row">{{$obj['id']}}</th>
                                    <td>{{$obj['first_name']}}</td>
                                    <td>{{$obj['last_name']}}</td>
                                    <td>{{$obj['section']['name']}}</td>
                                    <td>{{$obj['jobRole']['name']}}</td>
                                    <td class="text-right">
                                        <a href="{{url('admin/employees/info/'.$obj['id'])}}" class="btn btn-sm btn-info mr-1"><i class="fa fa-eye"></i></a>
                                        <a href="{{url('admin/employees/delete/'.$obj['id'])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
