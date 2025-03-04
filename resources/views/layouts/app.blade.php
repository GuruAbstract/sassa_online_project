@inject('notifications','App\Inject\Notifications')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> {{ config('app.name', 'Laravel') }}</a>


                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/">Home</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Accounts<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('transfers')}}"><span class="glyphicon glyphicon-transfer"></span>&nbsp;Inter-Account Transfers</a></li>
                                <li><a href="{{route('depositMoney')}}"><span class="glyphicon glyphicon-piggy-bank"></span>&nbsp;Deposit</a></li>
                                <li><a href="{{route('withdrawMoney')}}"><span class="glyphicon glyphicon-off"></span>&nbsp;Withdraw</a></li>
                                <li><a href="{{route('accounts')}}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Accounts Summary</a></li>
                            </ul>
                        </li>
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        @else


@if($notifications->getUnreadNotifications()->count()>0)

                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                     Notifications <span class="badge badge-primary" style="background-color: red">{{$notifications->getUnreadNotifications()->count()}}</span>
                                    </a>
                                <ul id="notifications" class="dropdown-menu">


   @foreach($notifications->getUnreadNotifications() as $notification)
    <li>
        <a href="{{ route('showproduct',
              ['notificationid'=>$notification->id]) }}"
           onclick="event.preventDefault();
                         document.getElementById('notification-{{$notification->id}}').submit();">
            <span class="glyphicon glyphicon-bell"></span>
            Product id
            {{' '.$notification->data['productid'] .'  '.
             $notification->data['type'] .'  Product Price  R' .
             $notification->data['amount']}}
        </a>

        <form id="notification-{{$notification->id}}"
              action="{{ route('showproduct',
              ['notificationid'=>$notification->id]) }}"
              method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>


@endforeach
                                </ul>
                                </li>
                         @endif

                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        {{'Hi '.Auth::user()->name.' '.Auth::user()->surname }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                                <img src="{{asset('storage/'.Auth::user()->photo)}}"/></a></li>

                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <span class="glyphicon glyphicon-log-out"></span>Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>

                                        <li><a href="{{route('setting')}}"><span class="glyphicon glyphicon-cog"></span>Setting</a></li>
                                        <li><a href="{{route('adduseraddress')}}"><span class="glyphicon glyphicon-cog"></span>Addresses</a></li>
                                        <li><a href="{{route('uploadprofile')}}"><span class="glyphicon glyphicon-cloud-upload"></span>Upload Profile</a></li>

                                    </ul>
                                </li>














                                @endguest
                              </ul>




                </div>
            </div>
        </nav>



    </div>

<div class="container">
    @yield('content')
</div>
@yield("bank")
    <script src="{{ asset("js/jquery3.2.1.js")}}"></script>

    <script>
        $(document).ready(function(){
            $("input").mouseleave(function(){
              var qtyid= $(this).attr('name') ;

             var code=qtyid.substr(3);


             var priceid="price_"+ code;

            var costid="cost_"+code;
               // var id=qtyid;

                   var qty=document.getElementById(qtyid).value.trim();
                    var price=document.getElementById(priceid).innerHTML.trim();

               var cos= qty*price;
                cos= parseFloat(Math.round(cos * 100) / 100).toFixed(2);

                document.getElementById(costid).innerText=cos.toString();


                  var total=0;


                /*$("[id^='cost_']").each(function(){
                    var t=$(this).val().toString();
                    t= parseFloat(t.substr(1));
                    total=total+t;*/

                    $.each($("[id^='cost']"), function (index, value) {
                     total= total+  parseFloat(value.innerHTML.trim());

                    });
                total= parseFloat(Math.round(total * 100) / 100).toFixed(2);
                   document.getElementById("totalcost").innerHTML=total.toString();


            });
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>
