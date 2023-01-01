@extends('layouts.admin')
@section('css')
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Add New</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('product-add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input name="name" value="{{old('name')}}" type="text" class="form-control @error('name')is-invalid @enderror">
                                        @error('name')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input name="qty" value="{{old('qty')}}" type="number" class="form-control @error('qty')is-invalid @enderror">
                                        @error('qty')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Min Qty Notify Level</label>
                                        <input name="min_qty_notify_level" value="{{old('min_qty_notify_level')}}" type="number" class="form-control @error('min_qty_notify_level')is-invalid @enderror">
                                        @error('min_qty_notify_level')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Unit Price</label>
                                        <input name="unit_price" value="{{old('unit_price')}}" type="number" class="form-control @error('unit_price')is-invalid @enderror">
                                        @error('unit_price')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Barcode</label>
                                        <input name="barcode" value="{{old('barcode')}}" type="text" class="form-control @error('barcode')is-invalid @enderror">
                                        @error('barcode')<span class="small text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="3" class="form-control @error('description')is-invalid @enderror">{{old('description')}}</textarea>
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
