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


                    @if($userall!=null)

                        @include('partial.transactionssummary',compact($mylist->getAccountSummaryForThisUser()->userall));

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>














@endsection
