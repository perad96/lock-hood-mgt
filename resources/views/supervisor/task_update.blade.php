@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Task Info - #{{$obj['id']}}</h5>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                            @if(isset($obj['reporter']))
                                <tr><th scope="row">Reporter</th><td>{{$obj['reporter']['first_name'].' '.$obj['reporter']['last_name']}}</td></tr>
                            @endif
                            @if(isset($obj['assignee']))
                                <tr><th scope="row">Assignee</th><td>{{$obj['assignee']['first_name'].' '.$obj['assignee']['last_name']}}</td></tr>
                            @endif
                            @if(isset($obj['description']))
                                <tr><th scope="row">Description</th><td>{{$obj['description']}}</td></tr>
                            @endif
                            @if(isset($obj['due_date']))
                                <tr><th scope="row">Due Date</th><td>{{$obj['due_date']}}</td></tr>
                            @endif
                            @if(isset($obj['started_at']))
                                <tr><th scope="row">Started At</th><td>{{$obj['started_at']}}</td></tr>
                            @endif
                            @if(isset($obj['finished_at']))
                                <tr><th scope="row">Finished At</th><td>{{$obj['finished_at']}}</td></tr>
                            @endif
                            <tr>
                                <th scope="row">Time Duration</th><td>
                                    @if(isset($obj['spend_hours'])){{$obj['spend_hours'].'h '}}@endif
                                    @if(isset($obj['spend_minutes'])){{$obj['spend_minutes'].'m'}}@endif
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <hr class="ml-0 mr-0">
                        <h4 class="mt-0 text-muted" style="font-weight: bold">Allocated Raw Materials For Task</h4>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty For Task</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($obj['taskMaterials'] as $material)
                                <tr>
                                    <td>{{$material['rawMaterial']['item_name']}}</td>
                                    <td>{{$material['qty']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body">
                        @if($obj['status'] == 'PENDING') <h5 class="mb-1"><span class="badge badge-warning w-100">Pending</span></h5>@endif
                        @if($obj['status'] == 'ONGOING') <h5 class="mb-1"><span class="badge badge-primary w-100">Ongoing</span></h5>@endif
                        @if($obj['status'] == 'FAILED') <h5 class="mb-1"><span class="badge badge-danger w-100">Failed</span></h5>@endif
                        @if($obj['status'] == 'HOLD') <h5 class="mb-1"><span class="badge badge-info w-100">Hold</span></h5>@endif
                        @if($obj['status'] == 'COMPLETED') <h5 class="mb-1"><span class="badge badge-success w-100">Completed</span></h5>@endif

                        <hr class="m-0 mt-2">
                        @if($obj['status'] != 'COMPLETED')
                            <form class="mt-2" method="post" action="{{route('task-update-supervisor')}}">
                                @csrf
                                <input name="id" value="{{$obj['id']}}" type="hidden">
                                <input name="reporter" value="{{$obj['reporter_id']}}" type="hidden">
                                <input name="assignee" value="{{$obj['assignee_id']}}" type="hidden">
                                <input name="description" value="{{$obj['description']}}" type="hidden">
                                <input name="due_date" value="{{$obj['due_date']}}" type="hidden">
{{--                                <input name="start_date" value="{{$obj['start_date']}}" type="hidden">--}}

                                <div class="form-group">
                                    <label>Task Status</label>
                                    <select name="status" class="form-control @error('status')is-invalid @enderror">
                                        <option value="">- Task Status -</option>
                                        @foreach($statusArr as $status)
                                            <option @if($status == old('status')) selected @elseif($status == $obj['status']) selected @endif value="{{$status}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                    @error('status')<span class="small text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Start At</label>
                                    <input name="start_date" value="{{(old('start_date') !== null) ? old('start_date') : $obj['started_at'] }}" type="datetime-local" class="form-control @error('start_date')is-invalid @enderror">
                                    @error('start_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Finished At</label>
                                    <input name="end_date" value="{{(old('end_date') !== null) ? old('end_date') : $obj['finished_at'] }}" type="datetime-local" class="form-control @error('end_date')is-invalid @enderror">
                                    @error('end_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Spend Hours</label>
                                    <input name="spend_hours" value="{{(old('spend_hours') !== null) ? old('spend_hours') : $obj['spend_hours'] }}" type="number" class="form-control @error('spend_hours')is-invalid @enderror">
                                    @error('spend_hours')<span class="small text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Spend Minutes</label>
                                    <input name="spend_minutes" value="{{(old('spend_minutes') !== null) ? old('spend_minutes') : $obj['spend_minutes'] }}" type="number" class="form-control @error('spend_minutes')is-invalid @enderror">
                                    @error('spend_minutes')<span class="small text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="row">
                                    <div class="update ml-auto mr-auto">
                                        <button type="submit" class="btn btn-primary btn-round">Update Task</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        window.onload = () => {
            onchangeOrderType();
        }
        function onchangeOrderType(){
            $('#divCustomOrder').hide();
            $('#divProductOrder').hide();

            const orderType = $('#selectOrderType').val();

            if(orderType === 'CUSTOM'){
                $('#divCustomOrder').show();
            }
            if(orderType === 'EXISTING_PRODUCT'){
                $('#divProductOrder').show();
            }
        }


        function customOrderAmountCalculate(){
            const discountPercentage = Number($('#customDiscountPercentage').val());
            const orderAmount = Number($('#customOrderAmount').val());
            const deliveryFee = Number($('#customOrderDeliveryFee').val());

            const totalAmount = orderAmount + deliveryFee;
            const discountAmount =  totalAmount * discountPercentage / 100;
            const subTotal = totalAmount - discountAmount;

            $('#customSubTotal').val(subTotal);
        }
    </script>
@endsection
