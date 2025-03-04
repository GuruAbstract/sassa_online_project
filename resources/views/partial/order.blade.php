@inject('address','App\Inject\AddressList)
@inject('deliveryAddress','App\Inject\DeliveryAddress)

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


                        @if($order!=null)
                            <table class="table table-responsive table-striped">

                                <tr>

                                    <th>Order Number</th>
                                    <th></th>
                                    <th>created_at</th>
                                    <th>totalcost</th>

                                    <th>Payment Done</th>
                                    <th>Delivery Status</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php $sum=0;?>



                                    <tr>

                                        <td> {{$order->orderid}} <td>
                                            <a class="btn btn-primary" href="/orderitems/{{$order->orderid}}">View</a>

                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->totalcost }}</td>
                                        <td>Yes</td>
                                        <td colspan="4">
                                            @if($order->order_tracks->count()>0)
                                                <button class="btn btn-warning" data-toggle="collapse" data-target="#prod{{$order->orderid}}">View Order Track</button>

                                                <div id="prod{{$order->orderid}}" class="collapse">

                                                    @include('partial.ordertrack',$order)

                                                </div>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>

                                        @foreach($deliveryAddress->get(Auth::id()) as $key=>$value)


                                            <td><strong>Address</strong></td>
                                            <td>  House No:{{$value->userhouseno}}</td>
                                            <td>Street  :{{$value->userstreetname}}</td>
                                            <td>Country :{{$value->usercountry}}</td>
                                            <td>Province:{{$value->userprovince}}</td>
                                            <td>Country:{{$value->usercountry}}</td>
                                            <td>Postal Code:{{$value->userpostalcode}}</td>
                                            <td>Contact No  :{{$value->usercontactno}}</td>











                                        @endforeach




                                    </tr>





                            </table>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>