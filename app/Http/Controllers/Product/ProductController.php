<?php
/*
 * Author: Donald Tutani
 * The Product controller class is derived from the Product table
 * of the database. The Product controller manages the 'Goods'
 * that are bought.
 */
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
/*
 * The access to the Products requires that a user be logged in
 * so the middleware is used to enforce this.
 */
    public function __construct()
    {
        $this->middleware('auth');
    }

/*
 * The function index() collects all the products  from the database
 * the function then passes controller to the view named 'products'
 * withing a 'product' folder
 */
    public function index()
    {
        $products=DB::table('products')->get();

        return view('product.products',compact('products'));
    }

    /*
     * for each product associated with the user in the notification
     * table, we mark the product as being seen. since the user has
     * viewed the product
     */

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
   /*
    * The user logged on must have the ability to store records
    * of type Product. The Policy is invoked  by calling the authorize()
    * method. If the user is not authorized the an exception
    * AuthorizationException is returned.
    *
    * If everything is okay, the product data is validated by calling
    * the validatingrequest() method
    * if validation is successful the product is committed to the database
    * and notification is sent to all the user about the new product
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

       $product->commit($request);
       Notification::send(User::all(),
           new NotifyNewProuctsAdded($request->productid,
                  $request->sellingprice));

        $status="Added successfully";
         return view('product.registerproduct',
             compact('status'));


        }
        catch (Exception $ee)
        {
            $status="Error in saving this record try again";

            return view('product.registerproduct',compact('status'));
        }
    }


    public function edit($id)
    {    $this->middleware('auth');
        $product=Product::find($id);

        return view('product.edit')->with('product',$product);
    }

}
