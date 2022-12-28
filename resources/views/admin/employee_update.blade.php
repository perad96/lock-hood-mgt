@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Update Employee Info</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('employee-update')}}">
                            @csrf
                            <input name="id" value="{{$obj['id']}}" type="hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input name="item_name" value="{{(old('item_name') !== null) ? old('item_name') : $obj['item_name'] }}" type="text" class="form-control @error('item_name')is-invalid @enderror">
                                        @error('item_name')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input name="sku" value="{{(old('sku') !== null) ? old('sku') : $obj['sku'] }}" type="text" class="form-control @error('sku')is-invalid @enderror">
                                        @error('sku')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select name="brand" class="form-control @error('brand')is-invalid @enderror">
                                            <option value="">- Select Brand -</option>
                                            @foreach($brandsArr as $brand)
                                                <option @if($brand['id'] == old('brand')) selected @elseif($brand['id'] == $obj['brand_id']) selected @endif value="{{$brand['id']}}">{{$brand['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category"
                                                class="form-control @error('category')is-invalid @enderror">
                                            <option value="">- Select Category -</option>
                                            @foreach($categoriesArr as $category)
                                                <option @if($category['id'] == old('category')) selected @elseif($category['id'] == $obj['category_id']) selected @endif value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select name="unit" class="form-control @error('unit')is-invalid @enderror">
                                            <option value="">- Select Unit -</option>
                                            @foreach($unitsArr as $unit)
                                                <option @if($unit['id'] == old('unit')) selected @elseif($unit['id'] == $obj['unit_id']) selected @endif value="{{$unit['id']}}">{{$unit['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('unit')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input name="qty" value="{{(old('qty') !== null) ? old('qty') : $obj['qty'] }}" type="number" class="form-control @error('qty')is-invalid @enderror">
                                        @error('qty')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Min Qty Notify Level</label>
                                        <input name="min_qty_notify_level" value="{{(old('min_qty_notify_level') !== null) ? old('min_qty_notify_level') : $obj['min_qty_notify_level'] }}" type="number" class="form-control @error('min_qty_notify_level')is-invalid @enderror">
                                        @error('min_qty_notify_level')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Barcode</label>
                                        <input name="barcode" value="{{(old('barcode') !== null) ? old('barcode') : $obj['barcode'] }}" type="text" class="form-control @error('barcode')is-invalid @enderror">
                                        @error('barcode')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lot Number</label>
                                        <input name="lot_number" value="{{(old('lot_number') !== null) ? old('lot_number') : $obj['lot_number'] }}" type="text" class="form-control @error('lot_number')is-invalid @enderror">
                                        @error('lot_number')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Expire Date</label>
                                        <input name="expire_date" value="{{(old('expire_date') !== null) ? old('expire_date') : $obj['expire_date'] }}" type="date" class="form-control @error('expire_date')is-invalid @enderror">
                                        @error('expire_date')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Purchase Unit Price</label>
                                        <input name="purchase_unit_price" value="{{(old('purchase_unit_price') !== null) ? old('purchase_unit_price') : $obj['purchase_unit_price'] }}" type="number" class="form-control @error('purchase_unit_price')is-invalid @enderror">
                                        @error('purchase_unit_price')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="3" class="form-control @error('description')is-invalid @enderror">{{(old('description') !== null) ? old('description') : $obj['description'] }}</textarea>
                                        @error('description')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Save</button>
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
@endsection
