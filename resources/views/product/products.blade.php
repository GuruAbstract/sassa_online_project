@extends('layouts.app')

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


                    <div class="row">
                        <form method="post" action="/buyselected">
                            {{csrf_field()}}

                  @foreach($products as $product)

                     <div class="col-lg-4">
                   <div class="panel panel-primary">
                       <div class="panel-heading">

                            {{$product->productname}}

                       </div>
                       <div class="panel-body">
                         <table>
                             <tr>
                                 <td><img width="100" height="150" src="{{asset('storage/'.$product->productphoto)}}"/></td>
                             </tr>
                             <tr>
                                 <td>Discount<br>  <span class="label label-success">{{$product->discountpercentage*100}}%</span></td>
                             <td >Before Discount<br> <em  class="label label-success">R{{$product->sellingprice}}</em></td>
                                 <td >After Discount<br> <span  class="label label-success">R{{$product->sellingprice-$product->discountpercentage*$product->sellingprice}}</span></td>

                             </tr>
                             <tr>
                                 <td>
                                     <label for="{{$product->productid}}"></label>
                                    <input class="form-control checkbox" type="checkbox" name="{{$product->productid}}" value="{{$product->productid}}" />
                                 </td>
                             </tr>
                         </table>
                       </div>


                   </div>

                    </div>
                            @endforeach
                            <input class="btn btn-success"
                                    type="submit"
                                   name="sale"
                                   id="sale"

                            value="Order"
                            />
                        </form>
                </div>

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

