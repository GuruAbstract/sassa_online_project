@extends('layouts.app')
@inject('mylist','App\Inject\AccountsSummary')
@inject('accountnos','App\Inject\AccountsNoList')
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


                    @if($products!=null)


                                @php
                                $sums=0;
                                @endphp

                            <form method="post" action="/orders">
                                {{csrf_field()}}
                                <table class="table table-responsive">
                                    <tr><td>Product</td><td>Unit Price</td><td>Items Ordered</td><td>Cost Per Product</td></tr>
                             @foreach($products as $product)
                                    @php
                                        $sums=$sums+$product->sellingprice-($product->sellingprice*$product->discountpercentage);

                                    @endphp

                                        <tr>

                                        <td>

                                            <img src="{{asset('storage/'.$product->productphoto)}}" width="40" height="40"/>
                                        </td>
                                        <td>Priced At R<label id="price_{{$product->productid}}" >{{$product->sellingprice-$product->sellingprice*$product->discountpercentage}}</label></td>

                                 <td>
                                     <input class="form-control"     type="number" name="id_{{$product->productid}}" id="id_{{$product->productid}}"
                                             value="1" onchange="compute(this);"
                                          min="1" onkeypress="function (e) {
                                                      if(!this.val().isNumber())
                                                          {
                                                            e.isInteger()
                                                          }
                                             }"   />

                                 </td>

                                <td>
                                    <span class="label label-success" style="font-size: large">
                                     R<label class="label label-success" id="cost_{{$product->productid}}">{{$product->sellingprice-($product->sellingprice*$product->discountpercentage)}}</label>
                                    </span>

                                 </td>


                                    </tr>

                            @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="label label-success" style="font-size: large"> Total &nbsp;&nbsp;
                                           @php
                                          //  $fmt = new NumberFormatter( 'US', NumberFormatter::CURRENCY );
                                            $str= 'R'.$sums;//$fmt->formatCurrency($sums, "US");
                                            //print('   '.$str.'         ');

                                             $rand=substr($str,0,1);
                                             $str=substr($str,1);
                                           echo $rand.'<em id="totalcost">'.$str.'</em>';
                                             @endphp
                                           </span>

                                            </td>
                                    </tr>
                            </table>
                                <br>
                                <h4>Select An Account To Use</h4>
                                <select name="accountfrom" id="accountfrom" class="form-control">


                                    @foreach($accountnos->get() as $key=>$value)
                                        <option value="{{$value->accountno}}" >{{$value->accountno}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <input class="form-control   btn btn-success"
                                       type="submit"
                                       name="sale"
                                       id="sale"

                                       value="Order"
                                />

                            </form>
                        @php
                            $userall=$mylist->getAccountSummaryForThisUser()
                                     ->userall;

                        @endphp
                            @include('partial.transactionssummary'
                            ,compact($userall));

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

