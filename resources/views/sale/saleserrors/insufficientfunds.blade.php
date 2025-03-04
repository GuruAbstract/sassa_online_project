@extends('layouts.app')
@inject('mylist','App\Inject\AccountsSummary')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<div class="well">
                    <span class="alert alert-danger">
                    {{$errormessage}}
                    </span></div>
                        @php
                         $userall =$mylist->getAccountSummaryForThisUser()->userall;

                        @endphp
                        @include('partial.transactionssummary',compact('userall'));


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
