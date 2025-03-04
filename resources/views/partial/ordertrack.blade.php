
{{--
 Created by PhpStorm.
 User: Donald.Tutani
 Date: 2017/12/15
 Time: 12:26 AM
--}}
<table class="table table-responsive table-striped">
@foreach($order->order_tracks as $track)
    <tr>
        <td>{{$track->created_at}}</td>
        <td>{{$track->orderstatus}}</td>
        <td></td>
        <td>{{$track->comment}}</td>
    </tr>

    @endforeach
    </table>