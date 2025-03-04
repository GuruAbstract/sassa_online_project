@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Account Deposit</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('deposit') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('accountfrom') ? ' has-error' : '' }}">
                            <label for="accountfrom" class="col-md-4 control-label">From Account</label>

                            <div class="col-md-6">

                                @if($errors->any())
                                    {{dd($errors)}}
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
                            <label for="transref" class="col-md-4 control-label">Reference Detail</label>

                            <div class="col-md-6">
                                <input type="text" name="transref" id="transref" class="form-control"/>

                                @if ($errors->has('transref'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transref') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Enter Amount To Deposit</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus/>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-piggy-bank"></span>&nbsp; Transfer
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
