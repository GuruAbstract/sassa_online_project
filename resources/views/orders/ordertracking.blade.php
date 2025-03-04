@extends('layouts.app')
@inject('OrderStatuses','App\Inject\OrderStatusOption')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Set The Status Of The Order</div>

                <div class="panel-body">
                    <div id="submissionstatus"></div>
                    <form  class="form-horizontal" method="POST" action="{{ route('setorderstatus') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('orderid') ? ' has-error' : '' }}">
                            <label for="orderid" class="col-md-4 control-label">Enter Order Number</label>

                            <div class="col-md-6">
                                <input type="text" name="orderid" id="orderid" class="form-control"/>

                                @if ($errors->has('orderid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('orderid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('orderstatus') ? ' has-error' : '' }}">
                            <label for="orderstatus" class="col-md-4 control-label">Select Order Status</label>

                            <div class="col-md-6">

                                @if($errors->any())
                                    {{dd($errors)}}
                                @endif
                                <select name="orderstatus" id="orderstatus" class="form-control">


                                    @foreach($orderstatuses->get() as $key=>$value)
                                     <option value="{{$value->orderstatus}}" >{{$value->orderstatus}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="comment" class="col-md-4 control-label">Product Description</label>

                            <div class="col-md-6">
                                <textarea style="border: #5bc0de; border-style: solid "  id="comment"  class="form-control" name="comment" required COLS="20" ROWS="6"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                       <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input id="itemtrackbtn" name="itemtrackbtn" type="submit" class="btn btn-primary"
                                  value='Save'  />
                                <span class="glyphicon-piggy-bank glyphicon-save-file"></span>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bank')

  <!--  <script src="{{ asset("js/bank.js")}}"></script>-->

    @endsection