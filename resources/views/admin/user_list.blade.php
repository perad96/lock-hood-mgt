@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <a href="{{url('admin/system-users/add')}}" class="btn btn-primary">+ New User</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Users List</h5>
                    </div>
                    <div class="card-body ">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allArr as $obj)
                                <tr>
                                    <th scope="row">{{$obj['id']}}</th>
                                    <td>{{$obj['first_name'].' '.$obj['last_name']}}</td>
                                    <td>{{$obj['email']}}</td>
                                    <td>{{$obj['role']}}</td>
                                    <td class="text-right">
                                        <a href="{{url('admin/system-users/info/'.$obj['id'])}}" class="btn btn-sm btn-info mr-1"><i class="fa fa-eye"></i></a>
                                        <a href="{{url('admin/system-users/delete/'.$obj['id'])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
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
