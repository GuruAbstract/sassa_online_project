@extends('layouts.app')
@inject('address','App\Inject\AddressList)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard

                    <div class="col-md-offset-9">
                        {{ $transactions->links()  }}

                    </div>

                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


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
                      <?php $sum=$sum+$detail->amount;

                      ?>
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

                                R{{$detail->amount}}
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
                      <td> <strong>R@php print($sums); @endphp</strong>
                      </td>
                      <td><a href="/">Back</a></td>
                  </tr>
              </table>

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

