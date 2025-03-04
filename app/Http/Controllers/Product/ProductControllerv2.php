<?php

namespace App\Http\Controllers\Product;

use App\Notifications\NotifyNewProuctsAdded;
use App\Product;
use App\Http\Controllers\Controller;
Use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Mockery\Exception;

use  Illuminate\Support\Facades\DB;
class ProductController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $products=DB::table('products')->get();

        return view('product.products',compact('products'));
    }
    public function showProductById($productid)
    {       $this->middleware('auth');

        $user=User::find(Auth::id());

        $notifications= $user->unreadNotifications;

        foreach($notifications as $notification )
        {
            if($notification->data['productid']==$productid)
        {
            $notification->markAsRead();
        }

        }

        $products=DB::table('products')
                       ->where('productid',$productid)->get();

        return view('product.products',compact('products'));
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
    public function store(Request $request,Product $product)

    {
        $this->middleware('auth');

   try {

       $this->authorize('store', $product);
   }catch (AuthorizationException $e )
        {
            return $e->getMessage();
        }
        try{
        $product=  new Product;

        $product->validatingrequest($request);


/*

            if(Auth::user()->can('store', Product::class))
            {

            }else{

            }

*/
        $product->commit($request);
  Notification::send(User::all(),new NotifyNewProuctsAdded($request->productid,$request->sellingprice));

        $status="Added successfully";
         return view('product.registerproduct',compact('status'));


        }
        catch (Exception $ee)
        {
            $status="Error in saving this record try again";

            return view('product.registerproduct',compact('status'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $this->middleware('auth');
        $product=Product::find($id);

        return view('product.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
