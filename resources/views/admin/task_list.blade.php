@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">

        <a href="{{url('admin/tasks/add')}}" class="btn btn-primary">+ New Task</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title d-flex align-items-center mt-0">
                            <span class="">Tasks List</span>
                            {{--                            <a href="{{url('admin/tasks/export')}}" class="btn btn-warning ml-auto m-0"><i class="fa fa-file-excel-o mr-2"></i>Export</a>--}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Reporter</th>
                                <th scope="col">Assignee</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allArr as $obj)
                                <tr>
                                    <th scope="row">{{$obj['id']}}</th>
                                    <td>{{$obj['reporter']['first_name'].' '.$obj['reporter']['last_name']}}</td>
                                    <td>{{$obj['assignee']['first_name'].' '.$obj['assignee']['last_name']}}</td>
                                    <td>
                                        @if($obj['status'] == 'PENDING') <h5 class="mb-0"><span class="badge badge-warning w-100">Pending</span></h5>@endif
                                        @if($obj['status'] == 'ONGOING') <h5 class="mb-0"><span class="badge badge-primary w-100">Ongoing</span></h5>@endif
                                        @if($obj['status'] == 'FAILED') <h5 class="mb-0"><span class="badge badge-danger w-100">Failed</span></h5>@endif
                                        @if($obj['status'] == 'HOLD') <h5 class="mb-0"><span class="badge badge-info w-100">Hold</span></h5>@endif
                                        @if($obj['status'] == 'COMPLETED') <h5 class="mb-0"><span class="badge badge-success w-100">Completed</span></h5>@endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{url('admin/tasks/info/'.$obj['id'])}}" class="btn btn-sm btn-info mr-1"><i class="fa fa-eye"></i></a>
                                        @if($obj['status'] != 'COMPLETED')
                                            <a href="{{url('admin/tasks/delete/'.$obj['id'])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        @endif
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
