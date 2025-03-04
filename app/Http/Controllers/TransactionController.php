<?php
/* User: Donald.Tutani
 * Date: 12/9/2017
 */
namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\PaginationServiceProvider;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Int_;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\OrderShipped;
use Mail;
class TransactionController extends Controller
{
   public function index($id)
    {
            $numberperpage=10;

        $userid=Auth::id();
        $transactions= DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->join('transactions','accounts.accountno',
                '=','transactions.accountno')
            ->where('users.id','=',$userid)
            ->where ('accounts.accountno','=',$id)

            ->select('transactions.*')->paginate($numberperpage);





        ;;

        $sum= DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->join('transactions','accounts.accountno','=','transactions.accountno')
            ->where('users.id',$userid)
            ->where('accounts.accountno',$id)
           // ->orderBy('Created_at')
            ->select('transactions.*')
            ->sum('transactions.amount');

        return view('transactions',
            compact('transactions'))
            ->with('sums',$sum)
            ->with('id',$id);



    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function topdf($accountno){

        $userid=Auth::id();
        $transactions= DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->join('transactions','accounts.accountno','=','transactions.accountno')
            ->where('users.id',$userid)
            ->where ('accounts.accountno',$accountno)
           // ->orderBy('Created_at')
            ->select('transactions.*')
            ->get();

        $sum= DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->join('transactions','accounts.accountno','=','transactions.accountno')
            ->where('users.id',$userid)
            ->where('accounts.accountno',$accountno)
           // ->orderBy('Created_at','asc')
            ->select('transactions.*')
            ->sum('transactions.amount');


         $pdf = PDF::loadView('transactionspdf',
             compact('transactions'));



        return $pdf->stream();


       /* return view('transactionspdf',
            compact('transactions'))
            ->with('sums',$sum)
            ->with('id',$id);*/
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
