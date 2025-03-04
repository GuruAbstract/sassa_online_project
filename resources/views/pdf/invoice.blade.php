<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <link href="/css/app.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css'" rel="stylesheet">

    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .btmth {
            border-bottom: 2px solid #ddd;
        }

        .btm {
            border-bottom: 1px solid #ddd;
        }

        .container {
            background: white;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-6">
                    <img src=" " class="img-responsive" alt="">
                </div>

                <div class="col-xs-2">
                </div>

                <div class="col-xs-4">
                    <h2 class="pull-right" style="display: inline-block;">Invoice</h2>
                     <h2>Invoice Number..:{{$user['invoiceid']}}</h2>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To</strong><br>
                        Company details here<br/>
                        Another line
                    </address>
                </div>
                <div class="col-xs-6 text-right">

                    <address>
                        <strong>Submitted By</strong><br>
                        <i class="fa fa-user" aria-hidden="true"> {{ $user['user'][0]->name }}</i><br>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i> {{ $user['user'][0]->email }}<br>
                        <i class="fa fa-mobile" aria-hidden="true"></i> @if(count($user['user'][0]->cellnumber)>0)
                            {!! nl2br($user['address']->usercontactno) !!}
                        @else
                            No mobile number has been submitted.
                        @endif <br>
                    </address>
                </div>
            </div>



            <div class="row">
                <div class="col-xs-6">

                    <address>
                        <strong>Invoice Date</strong><br>
                        {{ $user['invoice'][0]->updated_at }}<br><br>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Bank Details</strong><br>

                    </address>




                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Invoice Details</strong></h3>
                </div>

                <div>
                   <table  class="">
                    <tr>
                        <td>
                            <strong>ID/date</strong>
                        </td>

                        <td>
                           &nbsp;&nbsp; <strong>ProductId</strong>
                        </td>
                        <td>
                            <strong>Product Unit Cost</strong>
                        </td>
                        <td>
                            <strong>Quantity Bought</strong>
                        </td>
                        <td>
                            <strong>Line Cost</strong>
                        </td>

                </tr>

                    @foreach($user['invoice'] as $line)
                        <tr>

                            <td>
                              {{$line->orderitemid.'- '}} {{ $line->created_at }}
                            </td>
                            <td>
                                {{$line->productid}}
                            </td>
                            <td>
                                {{ $line->productunitcost }}
                            </td>
                            <td>
                                {{ $line->productqty }}
                            </td>
                            <td>
                                R {{ sprintf('%0.2f', $line->producttotalcost) }}
                            </td>

                        </tr>
                    @endforeach
                    <tr>
<td></td><td></td>
                        <td>

                        </td>
                        <td>
                            <strong>Total</strong>
                        </td>
                        <td>
                            <strong>R {{ sprintf('%0.2f', $user['sum']) }}</strong>
                        </td>


                </tr>
        </table>

            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>