<?php

namespace App\Http\Controllers\Order;


use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderTrack;
use App\OrderStatus;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
class OrderTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

public function track(){

        return view('orders.ordertracking');
}

    public  function tracksave(OrderTrack $request)
    {
        $order=Order::find($request->input('orderid'));


           $order->order_tracks()->create(
               [
                   'orderstatus' => $request->input('orderstatus'),
                   'comment' => $request->input('comment')]
           );




   return back()->withInput($request->all());

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderTrack  $orderTrack
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTrack $orderTrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderTrack  $orderTrack
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTrack $orderTrack)
    {
        $track=$orderTrack;
        return view('kk',compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderTrack  $orderTrack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderTrack $orderTrack)
    {
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderTrack  $orderTrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTrack $orderTrack)
    {
        //
    }
}
