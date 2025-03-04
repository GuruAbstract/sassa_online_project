<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Shop extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userall=DB::table('users')
            ->join('accounts','users.id','=','accounts.id')
            ->where('users.id','=',Auth::id())

            ->get();

        return $this->view('mail.mail',compact('userall'));
    }
}
