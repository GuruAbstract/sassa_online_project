<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($notificationid)
    {$user =User::find(Auth::id());
     $notification= $user->unreadNotifications->find($notificationid);
                     $notification->markAsRead();
     $productid=$notification->data['productid'];

/*
        return redirect()
            ->action('Product\ProductController@showProductById',
                      ['productid'=>$productid]  );*/

     //  return redirect()->action('showProductById@$productid',['productid'=>$productid] );
      return  redirect()->route('showThisProduct',['productid'=>$productid] );
        //    $products=DB::table('products')
        //      ->where('productid',$productid)->get();

        //  return view('product.products',compact('products'));

    }


    public function showProductById($productid)
    {
        $products=DB::table('products')
            ->where('productid',$productid)->get();

        return view('product.products',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
