@extends('layouts.app')
@inject('currentAddresses','App\Inject\AddressList')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Setting <br>
                <span class="alert-info">
                    <strong>0----></strong>Means you are not changing the current setting
                </span>
                </div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('setsetting') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('accountfrom') ? ' has-error' : '' }}">
                            <label for="accountfrom" class="col-md-4 control-label">Select An Account</label>

                            <div class="col-md-6">

                                @if($errors->any())

                                @endif
                                <select name="accountfrom" id="accountfrom" class="form-control">
                                    @foreach($accountnos as $key=>$value)
                                     <option value="{{$value->accountno}}" >{{$value->accountno}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('accountfrom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('accountfrom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('accountto') ? ' has-error' : '' }}">
                            <label for="limitamount" class="col-md-4 control-label">Set Maximum Withdrawal Per Transaction</label>

                            <div class="col-md-6">
                                <input type="text" name="limitamount" value="0" id="limitamount" class="form-control"/>

                                @if ($errors->has('limitamount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('limitamount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="dailylimit" class="col-md-4 control-label">Daily Limit Amount</label>

                            <div class="col-md-6">
                                <input id="dailylimit" type="text"  class="form-control" name="dailylimit" value="0" autofocus/>

                                @if ($errors->has('dailylimit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dailylimit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('isuserdeliveryaddress') ? ' has-error' : '' }}">
                            <label for="isuserdeliveryaddress" class="col-md-4 control-label">Change Delivery Address</label>
                            <div class="col-md-12">

                                <select  name="isuserdeliveryaddress" id="isuserdeliveryaddress" class="form-control">
                                    <option value="null">No Change In Address</option>
                                    @foreach($currentAddresses->getAddressList() as $address)

                                    <option value='{{$address->useraddressid}}' >House No{{' '.$address->userhouseno.' Street Name                 '.$address->userstreetname}}</option>

                                    @endforeach

                                </select>

                                @if ($errors->has('isuserdeliveryaddress'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isuserdeliveryaddress') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                       <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon-piggy-bank glyphicon-save-file">Save Setting</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
