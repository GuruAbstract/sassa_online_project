@extends('layouts.pdf')
@inject('DeliveryAddress','App\Inject\DeliveryAddress')
@section('content')


@foreach($DeliveryAddress->get(\Illuminate\Support\Facades\Auth::id()) as $key=>$address)

<div class="row">
    <div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">

            Account Holder Address

        </div>
        <div class="panel-body">
            <table width="50%">
                <tr>
                    <td> <img src="./storage/{{$address->useraddressesmap}}"/></td>
                </tr>

                <tr>
                    <td>{{$address->userhouseno}}</td>
                </tr>
                <tr>
                    <td>{{$address->userstreetname}}</td>
                </tr>
                <tr>
                    <td> {{$address->usercity}}</td>
                </tr>

                <tr>
                    <td> {{$address->userprovince}}</td>
                </tr>
                <tr>
                    <td> {{$address->usercountry}}</td>
                </tr>

                <tr>
                    <td>{{$address->userpostalcode}}</td>
                </tr>
                <tr>
                    <td>{{$address->usercontactno}}</td>
                </tr>





</table>
        </div>
    </div>
   </div>
</div>

@endforeach


                    @if($transactions!=null)
              <table class="table table-responsive table-striped">

                  <tr>

                      <th>Transaction Number</th>
                      <th>Transaction Date</th>
                      <th>Ref Description</th>
                      <th>Credit</th>
                      <th>Debit</th>
                      <th>Amount</th>
                      <th></th>
                  </tr>
                    <?php $sum=0;?>

                  @foreach($transactions as $detail)
                      <?php $sum=$sum+$detail->amount;?>
                     <tr>

                      <td>00{{$detail->transid}}</td>
                      <td>{{$detail->created_at}}</td>

                      <td>{{$detail->transref}}</td>
                       <td>
                           @if($detail->amount>=0)

                               {{$detail->amount}}
                           @endif


                       </td>
                        <td>
                            @if($detail->amount<0)

                                R{{$detail->amount*-1}}
                            @endif

                        </td>

                      <td>R<?php echo $sum; ?></td>

                      </tr>


                  @endforeach

                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Closing Balance</td>
                      <td> <strong>R<?php echo $sum; ?></strong>
                      </td>
                      <td><a href="/">Back</a></td>
                  </tr>
              </table>

                        @endif

@endsection