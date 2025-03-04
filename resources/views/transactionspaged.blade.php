@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard
                    {{ $transactions->appends(['sort' => 'votes'])->link() }}
                    <div class="col-md-offset-9">
                        <form method="POST" id="pageit" name="pageit"
                        action="{{route('transactionview')}}">
                           {{ csrf_field() }}
                            <input type="text" style="visibility: hidden" id="id" name="id" value="{{$id}}"/>
                            <input id="perpage" name="perpage" type="number" value="" placeholder="Enter The Number of Items to display per page">
                            <input type="submit" id="change" name="change" value="Change">
                        </form>

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
                      <td> <strong>R{{$sums}}</strong>
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

