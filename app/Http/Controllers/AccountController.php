<?php
/*
 * Author: Donald Tutani
 * The accounts controller class is derived from the account table
 * of the database. The account controller manages the 'banking'
 * aspects of the system.
 */
namespace App\Http\Controllers;
use App\Notifications\NotifyCashDeposited;
use App\Transaction;
use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use App\Rules\SufficientFunds;
use App\Rules\LimitFundWithdrawal;
use App\Rules\DailyLimitAmount;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyIntraAccountTransfer;
use App\Notifications\NotifyCashDepositFailure;
class AccountController extends Controller
{

    public function index()
    {
        $userall=DB::table('users')
            ->join('accounts','users.id','=','accounts.id')

            ->where('users.id','=',Auth::id())->get();

        return view('home', ['userall'=>$userall] );
    }


    public function create()
    {

    }
    /*
     * The function transfers() when called, get the accounts of the
     * current user and display a view named 'transfer'.
     * The view allows the user to do intra-accounts transfers
     */
    public function transfers(){
        $accountnos=DB::table('accounts')
                       ->where('accounts.id','=',Auth::id())
                       ->select('accountno')
                       ->get();

             Auth::user()->name;
        return view('transfer',compact('accountnos'));

    }














    /*
     * The function transferred accepts a request, and create the accounts
     * Object. We validate the accounts details by using validate()
     * method of the $request object based on th Rules:
     * SufficientFunds(), LimitFundWithdrawal() and DailylimitAmount()
     * If all conditions are met the code after the validation is
     * executed otherwise we return a response to the user with the
     * errors specified by the rules.
     * I demonstrate that in many transfer all the operation must
     * succeed otherwise all the operation reversed by implementing
     * the operations with a transaction. I do so by calling
     * DB::beginTransaction() and ending the transaction with a commit.
     * The user is then notified about the transfer of finds.
     * We do so by implementing the notify() function. An email is sent
     * to the user
     * */

    public  function transferred(Request $request)
    {
        $accountfrom=$request->input('accountfrom');
        $accountto=$request->input('accountto');
        $amount=$request->input('amount');

        $account=Account::find($accountfrom);

        $request->validate([
            'amount' => [
                'required', new SufficientFunds($accountfrom,
                        $accountto,$amount),
                new LimitFundWithdrawal($accountfrom),
                new DailyLimitAmount($accountfrom)
            ],

        ]);


     if($account->balance<$amount)
     {
         $msg='You dont have sufficient amount in your account please add more';
         return view('errorfundstransfer',compact(['msg','no']));
     }


  $accountfrom1=  Account::find($accountfrom);
  $accountto1=Account::find($accountto);
  try {
      DB::beginTransaction();
      $accountfrom1->balance -= $amount;
      $accountto1->balance += $amount;
      $accountfrom1->save();
      $accountto1->save();


      $trans1from = new Transaction;
      $transid = Transaction::all()
              ->max('transid') + 1;
      $trans1from->transid = $transid;
      $trans1from->transref = "Inter Account To " . $accountto;
      $trans1from->accountno = $accountfrom;
      $trans1from->amount = -1 * $amount;
      $trans1from->save();

      $trans2to = new Transaction;
      $transid = Transaction::all()
              ->max('transid') + 1;
      $trans2to->transid = $transid;
      $trans2to->transref = "Inter Account from " . $accountfrom;
      $trans2to->accountno = $accountto;
      $trans2to->amount = $amount;
      $trans2to->save();

      DB::commit();

     User::find(Auth::id())->notify(new NotifyIntraAccountTransfer($accountfrom1,$accountto1,$amount));


      return \redirect('/');
  }catch (Exception $ee)
  {
      DB::rollBack();
      $err=$ee->getMessage();
      return view('errorfundstransfer',compact('err'));
  }
 }



    /*
     * The withdrawshow function displays the view 'withdraw'
     * The view presents a form that allows the user to
     * withdraw amount.
     */
    public function withdrawshow()
    {
        $accountnos=DB::table('accounts')
            ->where('accounts.id','=',Auth::id())
            ->select('accountno')
            ->get();
        return view('withdraw',compact('accountnos'));
    }

    /*
      * The function deposit allows the systems to accepts
      * the deposit entered by the user. The deposit is committed
      * by calling the save() function of the $account object.
      * A transaction $transaction is created by call the constructor
      * the deposit transaction is recorded in the transaction table
      * by calling $transaction->save()
      */


    /*
   * The function depositshow, when called displays a view named
   * 'deposit'. The view allows the user to add money into selected
   * account from the list specified in $accountno.
   */
    public function depositshow()
    {
        $accountnos=DB::table('accounts')
            ->where('accounts.id','=',Auth::id())
            ->select('accountno')
            ->get();
        return view('deposit',compact('accountnos'));
    }


    /*
        * The function deposit allows the systems to accepts
        * the deposit entered by the user. The deposit is committed
        * by calling the save() function of the $account object.
        * A transaction $transaction is created by call the constructor
        * the deposit transaction is recorded in the transaction table
        * by calling $transaction->save()
        * A notification using email is set to the user based on whether
        * the operation was successful(NotifyCashDeposited) or not(NotifyCashDepositFailure)
        *
        */



 public  function deposit(Request $request)
 {
     try {
         DB::beginTransaction();
         $accountno = $request->input("accountfrom");
         $transref = $request->input("transref");
         $amount = $request->input("amount");
         $account = Account::find($accountno);
         //  dd($account);
         $account->balance = $account->balance + $amount;
         $account->save();

         $transaction = new Transaction;
         $transaction->accountno = $accountno;
         $transaction->amount = $amount;
         $transaction->transref = $transref;
         $transid = Transaction::all()
                 ->max('transid') + 1;
         $transaction->transid = $transid;
         $transaction->save();

         DB::commit();
         Notification::send(User::find(Auth::id()),new NotifyCashDeposited( $account,$amount));

     }catch(\Dompdf\Exception $e){
         DB::rollback();

         Notification::send(User::find(Auth::id()),new NotifyCashDepositFailure($request));
     }

     return \redirect('/');

 }

    public  function withdraw(Request $request)
    {
        $accountno=$request->input("accountfrom");
        $transref=$request->input("transref");
        $amount=$request->input("amount");
        $account=Account::find($accountno);

        $request->validate([
            'amount' => ['required',
                         new SufficientFunds($accountno,
                                  null,$amount),
                       //  new LimitFundWithdrawal($accountno),
                         new DailyLimitAmount($accountno)],
        ]);


        $account->balance =$account->balance-$amount;

        $account->save();

        $transaction=new Transaction;
        $transaction->accountno=$accountno;
        $transaction->amount=-1*$amount;
        $transaction->transref=$transref;

       $transid = Transaction::all()
                ->max('transid') + 1;
      $transaction->transid=$transid;
      //  $transaction->transid=null;
        $transaction->save();

        return \redirect('/');

    }
    /*
        * the function set() displays a view that allows the user
        * to set the limits such as daily withdrawal amount
        * monthly withdrawal amount.
        */
    public  function set()
    {
        $accountnos=DB::table('accounts')
            ->where('accounts.id','=',Auth::id())
            ->select('accountno')
            ->get();

            return view('setting',compact('accountnos'));

    }

    /*
     * The function Setting() commits the settings specified by
     * the view called by set() method
     *
     */

    public  function setting(Request $request)
    {
        $request->validate([
            'limitamount'=>['integer','min:0'],
              'dailylimit'=>['integer','min:0'],
            'accountfrom'=>['required']
        ]);
        $limitamount=$request->input('limitamount');
        $dailylimit=$request->input('dailylimit');
        $accountfrom=$request->input('accountfrom');
        $isuserdeliveryaddress=$request->input('isuserdeliveryaddress');
        $account=Account::find($accountfrom);

        if($dailylimit>=0)
        {
          $account->dailylimit=$dailylimit;
          $account->save();
        }
        if($limitamount>=0)
        {
            $account->limitamount=$limitamount;
            $account->save();
        }

      if($isuserdeliveryaddress)

     return \redirect('/');

    }



    public function destroy(Account $account)
    {
        //
    }
}
