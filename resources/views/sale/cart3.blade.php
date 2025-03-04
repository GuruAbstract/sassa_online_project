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



                            @foreach($products as $product)
                                    <form method="post" action="/orders" name="{{$product->productname}}">
                                        {{csrf_field()}}
                                        <table class="table table-responsive">
                                      <tr>

                                          <td>




                                        <td>


                                    <input style="visibility: hidden" id="{{$product->productid}}" name="{{$product->productid}}">

                                            <img src="{{asset('storage/'.$product->productphoto)}}" width="40" height="40"/>
                                        </td>
                                        <td>Priced At R{{$product->sellingprice}}</td>

                                 <td>
                                     <label for="{{$product->productid}}">10</label>
                                 </td><td>
                                     <input  type="hidden" name="{{$product->productid}}" value="10" />
                                 </td>

                                <td>
                                     <label>Total Cost R{{$product->sellingprice*10}}</label>

                                 </td>

                                    </tr>


                                </table>

                                        <input class="btn btn-success"
                                               type="submit"
                                               name="sale"
                                               id="sale"

                                               value="Order"
                                        />


                                    </form>
                            @endforeach



                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

