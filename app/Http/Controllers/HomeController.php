<?php

namespace App\Http\Controllers;

use App\Events\EventHome;
use App\Notifications\NotifyCashDeposited;
use App\Product;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\Shop;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\User;
use Illuminate\Database\Eloquent;

use Illuminate\Support\Facades\Notification;
use function MongoDB\BSON\toJSON;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::
        orderBy('created_at','desc')
                       ->get();

        return view('product.products',compact('products'));
    }



    public  function view(){
        $userall=DB::table('users')
            ->join('accounts','users.id','=','accounts.id')

            ->where('users.id','=',Auth::id())->get();

        return view('home', ['userall'=>$userall] );
    }
    public function ajaxRequest()

    {

        return view('ajaxRequest');

    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRequestPost()

    {
      /*  $input = request()->all();

        return response()->json(['notifications'=>'Got Simple Ajax Request.']);
*/

        $user = User::find(Auth::id());

        $notifications= $user->unreadNotifications;
        $str="";
        foreach($notifications as $notification)
        {
            foreach($notification->data as $data)
            {  $d=    \GuzzleHttp\json_encode($data);
                $str.=$d->type;
            }
        }



        return response($str);//json(["success"=>$notifications]);

    }
}
