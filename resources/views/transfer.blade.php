@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inter- Account Transfers</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('transferred') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('accountfrom') ? ' has-error' : '' }}">
                            <label for="accountfrom" class="col-md-4 control-label">From Account</label>

                            <div class="col-md-6">


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
                            <label for="accountto" class="col-md-4 control-label">From Account</label>

                            <div class="col-md-6">
                                <select name="accountto" id="accountto" class="form-control">
                                    @foreach($accountnos as $account)
                                        <option value="{{$account->accountno}}" >{{$account->accountno}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('accountto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('accountto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Enter Amount To Transfer</label>

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
                                    Transfer<span class="glyphicon-piggy-bank glyphicon-save-file"></span>
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
