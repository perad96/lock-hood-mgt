@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Place New Customer Order</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('customer-order-add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Order Type</label>
                                        <select onchange="onchangeOrderType()" id="selectOrderType" name="order_type" class="form-control @error('order_type')is-invalid @enderror">
                                            <option value="">- Select Order Type -</option>
                                            @foreach($orderTypesArr as $orderType)
                                                <option @if($orderType == old('order_type')) selected @endif value="{{$orderType}}">{{$orderType}}</option>
                                            @endforeach
                                        </select>
                                        @error('order_type')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select name="customer" class="form-control @error('customer')is-invalid @enderror">
                                            <option value="">- Select Customer -</option>
                                            @foreach($customersArr as $customer)
                                                <option @if($customer['id'] == old('customer')) selected @endif value="{{$customer['id']}}">{{$customer['id'].' | '.$customer['first_name'].' '.$customer['last_name'].' ('.$customer['company_name'].')'}}</option>
                                            @endforeach
                                        </select>
                                        @error('customer')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div id="divProductOrder" style="display: none">
                                <h5 class="text-muted mb-0 font-weight-bold">Products</h5>
                                <hr class="ml-0 mr-0">

                                <div class="row">
                                    <div class="col-md-6">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th class="col-1">Product ID</th>
                                                <th class="col-6">Name</th>
                                                <th class="col-3">Unit Price</th>
                                                <th class="col-2">Available Qty</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($productsArr as $product)
                                                <tr>
                                                    <td>{{$product['id']}}</td>
                                                    <td>{{$product['name']}}</td>
                                                    <td>{{$product['unit_price']}}</td>
                                                    <td>{{$product['qty']}}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6 p-3" style="border: 1px solid var(--dark)">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group mb-1">
                                                    <label>Product</label>
                                                    <input id="typeTwoProductTitle" class="form-control" readonly>
                                                    <input id="typeTwoAvailableQty" hidden>
                                                    <input id="typeTwoProductId" hidden>
                                                    <input id="typeTwoUnitPrice" hidden>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-1">
                                                    <label>Qty</label>
                                                    <input id="typeTwoQty" type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row flex-row-reverse">
                                            <div class="col-md-3">
                                                <button onclick="addItemToOrder()" type="button" class="btn btn-sm btn-info btn-block"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </div>
                                        <div id="warningMsg" class="alert alert-warning text-dark font-weight-bold" role="alert">
                                            Invalid qty!
                                        </div>

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="col-md-6">Description</th>
                                                <th scope="col" class="col-md-2">Qty</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tblTaskMaterial">
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <hr class="ml-0 mr-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Order Date</label>
                                        <input name="order_date" value="{{(old('order_date') !== null) ? old('order_date') : date('Y-m-d') }}" type="date" class="form-control @error('order_date')is-invalid @enderror">
                                        @error('order_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <input name="due_date" value="{{old('due_date')}}" type="date" class="form-control @error('due_date')is-invalid @enderror">
                                        @error('due_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Order Amount</label>
                                        <input onchange="customOrderAmountCalculate()" name="order_amount" id="customOrderAmount" value="{{old('order_amount')}}" type="number" class="form-control @error('order_amount')is-invalid @enderror">
                                        @error('order_amount')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Delivery Fee</label>
                                        <input onchange="customOrderAmountCalculate()" name="delivery_fee" id="customOrderDeliveryFee" value="{{old('delivery_fee')}}" type="number" class="form-control @error('delivery_fee')is-invalid @enderror">
                                        @error('delivery_fee')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Discount Percentage (%)</label>
                                        <input onchange="customOrderAmountCalculate()" name="discount_percentage" id="customDiscountPercentage" value="{{old('discount_percentage')}}" type="number" class="form-control @error('discount_percentage')is-invalid @enderror">
                                        @error('discount_percentage')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sub Total</label>
                                        <input name="sub_total" readonly id="customSubTotal" value="{{old('sub_total')}}" type="number" class="form-control @error('sub_total')is-invalid @enderror">
                                        @error('sub_total')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div id="divCustomOrder" style="display: none">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" rows="4" class="form-control @error('description')is-invalid @enderror">{{old('description')}}</textarea>
                                            @error('description')<span class="small text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row mt-3">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-primary btn-round">Place Order</button>
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
        $('#warningMsg').hide();

        window.onload = () => {
            onchangeOrderType();
        }
        function onchangeOrderType(){
            $('#divCustomOrder').hide();
            $('#divProductOrder').hide();

            const orderType = $('#selectOrderType').val();

            if(orderType === 'CUSTOM'){
                $('#divCustomOrder').show();
                $('#customOrderAmount').attr('readonly', false);
            }
            if(orderType === 'EXISTING_PRODUCT'){
                $('#divProductOrder').show();
                $('#customOrderAmount').attr('readonly', true);
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

        $(document).ready(function () {
            // $('#example').DataTable();

            let table = $('#example').DataTable();

            $('#example tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    const rowData = table.row(this).data();
                    $('#typeTwoProductTitle').val(rowData[1]);
                    $('#typeTwoAvailableQty').val(rowData[3]);
                    $('#typeTwoProductId').val(rowData[0]);
                    $('#typeTwoUnitPrice').val(rowData[2]);

                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            // $('#button').click(function () {
            //     table.row('.selected').remove().draw(false);
            // });
        });


        let tblTaskMaterialRowIndex = 0;
        const tblTaskMaterialRows = [];
        function addItemToOrder() {
            $('#warningMsg').hide();
            const productId = $('#typeTwoProductId').val();
            const description = $('#typeTwoProductTitle').val();
            const qty = Number($('#typeTwoQty').val());
            const availableQty = Number($('#typeTwoAvailableQty').val());
            const unitPrice = Number($('#typeTwoUnitPrice').val());

            if (qty > availableQty){
                $('#warningMsg').show();
                return true;
            }

            const orderAmount = Number($('#customOrderAmount').val());
            const newOrderAmount = (qty * unitPrice) + orderAmount;
            $('#customOrderAmount').val(newOrderAmount);

            let html = "";
            html += '<tr id="task_material_row_' + tblTaskMaterialRowIndex + '">';
            html += '<td>';
            html += '<input name="description_' + tblTaskMaterialRowIndex + '" id="description_' + tblTaskMaterialRowIndex + '" type="text" class="form-control" value="'+description+'" readonly>';
            html += '<input name="product_id[]" id="product_id_' + tblTaskMaterialRowIndex + '" value="'+productId+'" hidden>';
            html += '</td>';
            html += '<td>';
            html += '<input value="'+qty+'" name="qty[]" id="qty_' + tblTaskMaterialRowIndex + '" type="number" class="form-control" readonly>';
            html += '<input value="'+unitPrice+'" id="unit_price_' + tblTaskMaterialRowIndex + '" type="number" hidden>';
            html += '</td>';
            html += '<td class="text-right">'
            html += '<button onclick="removeTaskTblRow(' + tblTaskMaterialRowIndex + ')" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'
            html += '</td>';
            html += '</tr>';

            $('#tblTaskMaterial').append(html);
            tblTaskMaterialRowIndex++;

            $('#typeTwoProductId').val('');
            $('#typeTwoProductTitle').val('');
            $('#typeTwoQty').val('');
        }

        function removeTaskTblRow(id) {
            const row_id = '#task_material_row_' + id;
            const inputQtyId = '#qty_' + id;
            const inputUnitPriceId = '#unit_price_' + id;

            const qty = Number($(inputQtyId).val());
            const price = Number($(inputUnitPriceId).val());

            const amount = qty * price;

            const orderAmount = Number($('#customOrderAmount').val());
            const newOrderAmount = orderAmount - amount;
            $('#customOrderAmount').val(newOrderAmount);

            $(row_id).remove();
        }
    </script>
@endsection
