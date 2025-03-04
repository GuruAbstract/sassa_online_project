<?php
/*
 * Author: Donald Tutani
 * For each order, the user makers, an order mail is sent to the user
 * */
namespace App\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Barryvdh\DomPDF\Facade as PDF;
class OrderShipped2 extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $accountno;
    public function __construct($accountno)
    {
        $this->accountno=$accountno;
    }

    /**
     * The email, includes an attachment for downloading
     * this is a good practice in my view. A pdf format is
     * generated

     */
    public function build()
    {

        $userid=Auth::id();
        $transactions= DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->join('transactions','accounts.accountno','=','transactions.accountno')
            ->where('users.id',$userid)
            ->where ('accounts.accountno',$this->accountno)

            ->select('transactions.*')
            ->get();

        $sum= DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->join('transactions','accounts.accountno','=','transactions.accountno')
            ->where('users.id',$userid)
            ->where('accounts.accountno',$this->accountno)

            ->select('transactions.*')
            ->sum('transactions.amount');


        $pdf = PDF::loadView('transactionspdf',
            compact('transactions'));


        $this->view('sale.order')
            ->attachData($pdf, 'name.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
