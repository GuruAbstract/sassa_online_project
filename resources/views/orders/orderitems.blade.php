@extends('layouts.app')
@inject('address','App\Inject\AddressList)
@inject('deliveryAddress','App\Inject\DeliveryAddress)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard

                    <div class="col-md-offset-9">


                    </div>

                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if($orderitems!=null)
              <table class="table table-responsive table-striped">

            <tr>
              <th>Item Code</th>
              <th>Order Number</th>
              <th>created_at</th>
              <th>productid</th>
              <th>productunitcost</th>
              <th>Qty</th>
              <th>percentagediscount</th>
              <th>producttotalcost</th>
          </tr>


                  @foreach($orderitems as $orderitem)
                     <tr>
                      <td> {{$orderitem->orderitemid}} </td>
                      <td>{{$orderitem->orderid}}</td>
                      <td>{{$orderitem->created_at }}</td>
                      <td> {{$orderitem->productid}} </td>
                      <td>{{$orderitem->productunitcost}}</td>
                      <td>{{$orderitem->productqty }}</td>
                      <td>{{$orderitem->percentagediscount}}</td>
                      <td>{{$orderitem->producttotalcost}}</td>

                     </tr>

                  @endforeach


              </table>
                             <a class="btn btn-danger" href="/ordersitems">Back</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

