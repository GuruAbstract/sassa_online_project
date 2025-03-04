<?php

namespace App\Http\Controllers;

use App\Account;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Transaction;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $d=$request->all();
     $d= array_except($d,['_token','sale']);

       $products= DB::table('products')
            ->whereIn('productid',$d)
            ->get();
       return view('sale.cart',compact('products'));

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
    public function orders(Request $request)
    {



             $accno=$request->input('accountfrom');

           $account=DB::table('accounts')
                        ->where('accountno',$accno)
                        ->select('balance')
                        ->first();

        $deliveryuseraddressids=  DB::table('user_addresses')
            ->where('id','=',Auth::id())
            ->where('isuserdeliveryaddress',1)
            ->distinct('useraddressid')
            ->select('useraddressid')
            ->first();
        ;

        if($deliveryuseraddressids==null)
        {

            $addressExists=  DB::table('user_addresses')
                ->where('id','=',Auth::id())
               ->distinct('useraddressid')
                ->select('useraddressid')->get();

            if($addressExists->count()==0)
            {
                return redirect('/adduseraddress');
            }


            $accountnos=DB::table('accounts')
                ->where('accounts.id','=',Auth::id())
                ->select('accountno')
                ->get();

            $setdeliveryaddress='Please set the delivery address';



            return  view('setting',compact('accountnos'));
        }

        $d= array_except($request->all(),['_token','sale','accountfrom']);

        $accumTotalAmount=0;
        $orderdetails=[];
        $kk="";
        $tcost=0;
        foreach($d as $key=>$value)
        {

            $product=Product::find(substr($key,3));
            $tcost=$product->sellingprice*$value;

            $discountpercentage=
                $product->discountpercentage!=null
                    ?$product->discountpercentage:0;

            $tcost=$tcost-$tcost*$discountpercentage;
          $kk=$kk.'   '.$tcost."<br>";

            $accumTotalAmount=$accumTotalAmount+$tcost;
            $orderdetail=[
                'orderid'=>null,
                'productid'=>$product->productid,
                'productunitcost'=>$product->sellingprice,
                'productqty'=>$value,
                'producttotalcost'=>$tcost,
                'percentagediscount'=>$discountpercentage,
            ];
          array_push($orderdetails,$orderdetail);
        }

        $ccamount=($account->balance)*1;

    if($ccamount<$accumTotalAmount)
    {      //return low balance increase it before trying again
        $errormessage="You do not have sufficient funds in the account -->$accno<--";
        return view('sale.saleserrors.insufficientfunds'
            ,compact('errormessage')) ;
    }

         $orderid=DB::table('orders')
                      ->insertGetId([
                         'userid'=>Auth::id(),
                          'totalcost'=>$accumTotalAmount,
                          'deliveryaddressid'=>$deliveryuseraddressids->useraddressid,
                      ]);

       $order=Order::find($orderid);
            //dd($orderdetails);
       $order->order_items()->createMany(
                $orderdetails
       );

        $newamount=$ccamount-$accumTotalAmount;

       DB::table('accounts')
               ->where('accountno',$accno)
               ->update(['balance'=>$newamount]);
        $transaction=new Transaction;

        $transaction->amount=-1*$accumTotalAmount;
        $transaction->transref='Order N# '.$orderid;

        $account=Account::find($accno);
         $account->transactions()->save($transaction);

         dd('here');

   return view('sale.salessuccess.success',compact('order'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
