@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Order Info - #{{$obj['id']}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted font-weight-bold">{{$obj['customer']['first_name'].' '.$obj['customer']['last_name'].' ('.$obj['customer']['company_name'].')'}}</p>

                        <table class="table table-bordered">
                            <tbody>
                            @if(isset($obj['order_type']))
                                <tr><th scope="row">Order Type</th><td>{{$obj['order_type']}}</td></tr>
                            @endif
                            @if(isset($obj['description']))
                                <tr><th scope="row">Description</th><td>{{$obj['description']}}</td></tr>
                            @endif
                            @if(isset($obj['order_date']))
                                <tr><th scope="row">Order Date</th><td>{{$obj['order_date']}}</td></tr>
                            @endif
                            @if(isset($obj['due_date']))
                                <tr><th scope="row">Due Date</th><td>{{$obj['due_date']}}</td></tr>
                            @endif
                            @if(isset($obj['discount_percentage']))
                                <tr><th scope="row">Discount Percentage</th><td>{{$obj['discount_percentage']}}%</td></tr>
                            @endif
                            @if(isset($obj['delivery_fee']))
                                <tr><th scope="row">Delivery Fee</th><td>{{$obj['delivery_fee']}}</td></tr>
                            @endif
                            @if(isset($obj['sub_total']))
                                <tr><th scope="row">Sub Total</th><td>{{$obj['sub_total']}}</td></tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body">
                        @if($obj['status'] == 'PENDING') <h5 class="mb-1"><span class="badge badge-warning w-100">Pending</span></h5>@endif
                        @if($obj['status'] == 'REJECT') <h5 class="mb-1"><span class="badge badge-danger w-100">Reject</span></h5>@endif
                        @if($obj['status'] == 'DELIVERED') <h5 class="mb-1"><span class="badge badge-info w-100">Delivered</span></h5>@endif
                        @if($obj['status'] == 'COMPLETE') <h5 class="mb-1"><span class="badge badge-success w-100">Complete</span></h5>@endif

                        <hr class="m-0 mt-2">
                        <form class="mt-2" method="post" action="{{route('customer-order-update')}}">
                            @csrf
                            <input name="id" value="{{$obj['id']}}" type="hidden">

                            <div class="form-group">
                                <label>Order Status</label>
                                <select name="gender" class="form-control @error('gender')is-invalid @enderror">
                                    <option value="">- Select Order Status -</option>
                                    @foreach($statusArr as $status)
                                        <option @if($status == old('status')) selected @endif value="{{$status}}">{{$status}}</option>
                                    @endforeach
                                </select>
                                @error('status')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Delivered Date</label>
                                <input name="delivered_date" value="{{old('delivered_date')}}" type="date" class="form-control @error('delivered_date')is-invalid @enderror">
                                @error('delivered_date')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Update Order</button>
                                </div>
                            </div>
                        </form>
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
