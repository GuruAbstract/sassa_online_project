@extends('layouts.app')
@inject('mylist','App\Inject\AccountsSummary')
@section('content')

    @include('partial.order',$order)
    <a class="btn btn-primary" href="./invoice/{{$order->orderid}}"><span class="glyphicon glyphicon-cloud-download"></span>View Invoice</a>
@endsection
