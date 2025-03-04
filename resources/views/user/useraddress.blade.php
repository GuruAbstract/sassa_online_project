@extends('layouts.app')
@inject('producttypes','App\Inject\ProductTypes')
@inject('supplierlist','App\Inject\SupplierList')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add An Address</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('saveuseraddress') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('userhouseno') ? ' has-error' : '' }}">
                                <label for="userhouseno" class="col-md-4 control-label">House Number</label>

                                <div class="col-md-6">
                                    <input id="userhouseno" type="text" class="form-control" name="userhouseno" value="{{ old('userhouseno') }}" required autofocus/>

                                    @if ($errors->has('userhouseno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userhouseno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('userstreetname') ? ' has-error' : '' }}">
                                <label for="userstreetname" class="col-md-4 control-label">Street Name</label>

                                <div class="col-md-6">
                                    <input id="userstreetname" type="text" class="form-control" name="userstreetname" value="{{ old('userstreetname') }}" required autofocus/>

                                    @if ($errors->has('userstreetname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userstreetname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                         <div class="form-group{{ $errors->has('usercity') ? ' has-error' : '' }}">
                            <label for="usercity" class="col-md-4 control-label">City Name</label>

                            <div class="col-md-6">
                                <input id="usercity" type="text" class="form-control" name="usercity" value="{{ old('usercity') }}" required autofocus>

                                @if ($errors->has('usercity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usercity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('userpostalcode') ? ' has-error' : '' }}">
                                <label for="userpostalcode" class="col-md-4 control-label">User Postal Code</label>

                                <div class="col-md-6">
                                    <input id="userpostalcode" type="text" class="form-control" name="userpostalcode" value="{{ old('userpostalcode') }}" required autofocus>

                                    @if ($errors->has('userpostalcode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userpostalcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('userprovince') ? ' has-error' : '' }}">
                                <label for="userprovince" class="col-md-4 control-label">Your Province</label>

                                <div class="col-md-6">
                                    <input id="userprovince" type="text" class="form-control" name="userprovince" value="{{ old('userprovince') }}" autofocus>

                                    @if ($errors->has('userprovince'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userprovince') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('usercountry') ? ' has-error' : '' }}">
                                <label for="usercountry" class="col-md-4 control-label">Country</label>

                                <div class="col-md-6">
                                    <input id="usercountry" type="text" class="form-control" name="usercountry" value="{{ old('usercountry') }}" required autofocus>

                                    @if ($errors->has('usercountry'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('usercountry') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('usercontactno') ? ' has-error' : '' }}">
                                <label for="usercontactno" class="col-md-4 control-label">Contact Number</label>

                                <div class="col-md-6">
                                    <input id="usercontactno" type="text" class="form-control" name="usercontactno" value="{{ old('usercontactno') }}" required autofocus>

                                    @if ($errors->has('usercontactno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('usercontactno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('isuserdeliveryaddress') ? ' has-error' : '' }}">
                                <label for="isuserdeliveryaddress" class="col-md-4 control-label">Is Delivery Address</label>
                                <div class="col-md-6">

                                    <select name="isuserdeliveryaddress" id="isuserdeliveryaddress" class="form-control">
                                        <option value='1' >Yes</option>
                                        <option value='0' >No</option>
                                    </select>

                                    @if ($errors->has('isuserdeliveryaddress'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('isuserdeliveryaddress') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="form-group{{ $errors->has('useraddressesmap') ? ' has-error' : '' }}">
                              <label for="useraddressesmap" class="col-md-4 control-label">User Addresses Map</label>

                              <div class="col-md-6">
                                <input id="useraddressesmap" type="file" class="form-control" name="useraddressesmap" value="{{ old('useraddressesmap') }}" required autofocus/>

                                @if ($errors->has('useraddressesmap'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('useraddressesmap') }}</strong>
                                    </span>
                                @endif
                            </div>
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
