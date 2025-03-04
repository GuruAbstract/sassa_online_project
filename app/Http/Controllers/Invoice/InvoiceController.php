<?php

namespace App\Http\Controllers\invoice;

use App\Account;
use App\Order;
use App\OrderItem;
use App\ProductType;
use App\UserAddress;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\invoice\PrintInoice;

use App\Supplier;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderid=80;


            $invoice = DB::table("orders")
                ->join('order_items', 'orders.orderid', 'order_items.orderid')
                ->where('orders.userid', 23)
                ->where('orders.orderid', $orderid)
                ->get();

            $sum = DB::table("orders")
                ->join('order_items', 'orders.orderid', 'order_items.orderid')
                ->where('orders.userid', 23)
                ->where('orders.orderid', $orderid)
                ->sum('producttotalcost');
            $address = UserAddress::where('id', 23)
                ->where('isuserdeliveryaddress', 1)
                ->distinct()
                ->first();
            $user = ['user' => DB::table('users')
                ->where('id', 23)
                ->distinct()
                ->get(),
                'address' => $address,
                'invoice' => $invoice,
                'sum' => $sum,
                'invoiceid' => $orderid,
            ];

            //  return view('pdf.invoice',compact('user'));
            //  return $pdf->inline('invoice-'.str_pad($invoice->id,5,"0", STR_PAD_LEFT).'.pdf');

            $pdf= PDF::loadView('pdf.invoice',
                compact('user'));
     return  $pdf->stream();





    }
    public function invoicestream($orderid)
    {



        $invoice = DB::table("orders")
            ->join('order_items', 'orders.orderid', 'order_items.orderid')
            ->where('orders.userid', 23)
            ->where('orders.orderid', $orderid)
            ->get();

        $sum = DB::table("orders")
            ->join('order_items', 'orders.orderid', 'order_items.orderid')
            ->where('orders.userid', 23)
            ->where('orders.orderid', $orderid)
            ->sum('producttotalcost');
        $address = UserAddress::where('id', 23)
            ->where('isuserdeliveryaddress', 1)
            ->distinct()
            ->first();
        $user = ['user' => DB::table('users')
            ->where('id', 23)
            ->distinct()
            ->get(),
            'address' => $address,
            'invoice' => $invoice,
            'sum' => $sum,
            'invoiceid' => $orderid,
        ];

        //  return view('pdf.invoice',compact('user'));
        //  return $pdf->inline('invoice-'.str_pad($invoice->id,5,"0", STR_PAD_LEFT).'.pdf');

        $pdf= PDF::loadView('pdf.invoice',
            compact('user'));
        return  $pdf->stream();





    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {  $accounts=Account::with('transactions')
                          ->where('accounts.accountno',1000000000000001)->get() ;

              print('<pre>');
           foreach($accounts[0]->transactions as $transaction)
           {

                   print($transaction);

           };
           print('</pre>');


        dd('ddd');
    }

    
    
    
    

    public function test23()
    {  $productytype=ProductType::find('chicken');
         print("<pre>");
       foreach($productytype->products as $product)
       {
           dd($product->supplier);
       }
        print("</pre>");
    }




    public function test11()
    {   $order= Order::find(68);

    dd($order->products);




    }





    public function test2()
    {   $user= Order::find(68)->user;


        foreach($user->orderitems as $orderitem)
        {
            print("<pre>");
              print_r($orderitem);

            print("</pre>");
        }


    }

















    public function test1()
    {   $id= Order::find(68)->user;
             $myid=$id->id;
             ;
        foreach($id->accounts as $account)
        {
        foreach($account->transactions as $transaction)
        {   print('<pre>');
           print_r(Account::find($transaction->account->accountno));
           print('</pre>');
        }

        }

        dd('============================');
        $id2=new \App\Http\Controllers\invoice\PrintInoice();
        $id2->name='tata';
        $id4=new \App\Http\Controllers\invoice\PrintInoice();
        $id4->name='peter';
        $id4->id=10;
        return view('demo1',compact('id','id2','id4'));
    }
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
    public function edit($id)
    {
        //
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
