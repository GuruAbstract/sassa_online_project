<?php

namespace App\Rules;

use App\Transaction;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Account;
class DailyLimitAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
     private $accountno=0;
     private $withdrawable=0;
     private $dailylimittoday=0;
    public function __construct($accountno)
    {
        $this->accountno=$accountno;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $sumwithdrawntoday=Transaction::
        where('accountno',$this->accountno)
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),
                DB::raw("(DATE_FORMAT(CURRENT_DATE,'%Y-%m-%d'))"))
            ->sum('amount');

     $dailylimit=Account::find($this->accountno)->dailylimit;
      $this->withdrawable=$dailylimit-$sumwithdrawntoday;
      $this->dailylimittoday=$dailylimit;
      $canwithdraw=$sumwithdrawntoday+$value<$dailylimit;
     if($canwithdraw)
     {
         return true;
     }
     else{
         return false;
     }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Exceeding Daily Limit Not Allowed. You can only withdraw/transfer   R'.$this->withdrawable.' Per Day';
    }
}
