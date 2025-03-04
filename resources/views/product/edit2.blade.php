@extends('layouts.app')
@inject('producttypes','App\Inject\ProductTypes')
@inject('supplierlist','App\Inject\SupplierList')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Register A Product</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action=" " enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input id="productid" type="hidden" class="form-control" name="productid" value="{{ $product->name}}" required autofocus/>

                        <div class="col-lg-6">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="productname" class="col-md-4 control-label">Product Name</label>

                            <div class="col-md-6">
                                <input id="productname" type="text" class="form-control" name="productname" value="{{ $product->productname}}" required autofocus>

                                @if ($errors->has('productname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productphoto') ? ' has-error' : '' }}">
                            <label for="productphoto" class="col-md-4 control-label">Upload Product Photo</label>

                            <div class="col-md-6">
                                <input id="productphoto" type="file" class="form-control" name="productphoto" value="{{ old('productphoto') }}" required autofocus/>

                                @if ($errors->has('productphoto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productphoto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('discountpercentage') ? ' has-error' : '' }}">
                            <label for="discountpercentage" class="col-md-4 control-label">Discount Percentage</label>

                            <div class="col-md-6">
                                <input id="discountpercentage" type="text" class="form-control" name="discountpercentage" value="{{$product->discountpercentage}}" required autofocus/>

                                @if ($errors->has('discountpercentage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discountpercentage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('purchaseprice') ? ' has-error' : '' }}">
                            <label for="purchaseprice" class="col-md-4 control-label">Purchase Price</label>

                            <div class="col-md-6">
                                <input id="purchaseprice" type="text" class="form-control" name="purchaseprice" value="{{ $product->purchaseprice}}" required autofocus/>

                                @if ($errors->has('purchaseprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('purchaseprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sellingprice') ? ' has-error' : '' }}">
                            <label for="sellingprice" class="col-md-4 control-label">Product Selling Price</label>

                            <div class="col-md-6">
                                <input id="sellingprice" type="tel" class="form-control" name="sellingprice" value="{{$product->sellingprice }}" required>

                                @if ($errors->has('sellingprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sellingprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('stocklevel') ? ' has-error' : '' }}">
                            <label for="stocklevel" class="col-md-4 control-label">Stock Level</label>

                            <div class="col-md-6">
                                <input id="stocklevel" type="number" class="form-control" name="stocklevel" value="{{$product->stocklevel }}" required min="1">

                                @if ($errors->has('stocklevel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stocklevel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('productquantity') ? ' has-error' : '' }}">
                                <label for="productquantity" class="col-md-4 control-label">Product Quantity</label>

                                <div class="col-md-6">
                                    <input id="productquantity" type="number" class="form-control" name="productquantity" value="{{ $product->productquantity }}" required min="1">

                                    @if ($errors->has('productquantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('productquantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('reorderlevel') ? ' has-error' : '' }}">
                                <label for="reorderlevel" class="col-md-4 control-label">Product Reorder Level</label>

                                <div class="col-md-6">
                                    <input id="reorderlevel" type="number" class="form-control" name="reorderlevel" value="{{$product->reorderlevel }}" required min="1">

                                    @if ($errors->has('reorderlevel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('reorderlevel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('productdescription') ? ' has-error' : '' }}">
                            <label for="productdescription" class="col-md-4 control-label">Product Description</label>

                            <div class="col-md-6">
                                <textarea style="border: #5bc0de; border-style: solid "  id="productdescription"  class="form-control" name="productdescription" required COLS="20" ROWS="6">{{$product->productdescription}}</textarea>

                                @if ($errors->has('productdescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productdescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group{{ $errors->has('manufactureddate') ? ' has-error' : '' }}">
                            <label for="manufactureddate" class="col-md-4 control-label">Product Manufactured Date</label>

                            <div class="col-md-6">
                                <input type="date"  id="manufactureddate"  class="form-control" name="manufactureddate" value="{{$product->manufactureddate}}" />

                                @if ($errors->has('manufactureddate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manufactureddate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('expirydate') ? ' has-error' : '' }}">
                                <label for="expirydate" class="col-md-4 control-label">Product Expiry Date</label>

                                <div class="col-md-6">
                                    <input type="date"  id="expirydate"  class="form-control" name="expirydate"  value="{{$product->expireydate}}"/>

                                    @if ($errors->has('expirydate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('expirydate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                        <div class="form-group{{ $errors->has('producttype') ? ' has-error' : '' }}">
                            <label for="producttype" class="col-md-4 control-label">Product Type</label>

                            <div class="col-md-6">


                                <select name="producttype" id="producttype" class="form-control">



                                    @foreach($producttypes->getProductTypes() as $key=>$value)
                                        <option value="{{$value->producttype}}" >{{$value->producttype}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('producttype'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('producttype') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>



                            <div class="form-group{{ $errors->has('supplierid') ? ' has-error' : '' }}">
                                <label for="supplierid" class="col-md-4 control-label">Supplier Name</label>

                                <div class="col-md-6">


                                    <select name="supplierid" id="supplierid" class="form-control">


                                        @foreach($supplierlist->getSuppliers() as $key=>$value)
                                            <option value="{{$value->supplierid}}" >{{$value->suppliername}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('supplierid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('supplierid') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
