<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\DB;
use App\Account;
class LimitFundWithdrawal implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $accountno=0;
    private $amountwithdraw=0;
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
        $amountlimit=Account::find($this->accountno)->limitamount;
       $this->amountwithdraw=$value;
        if($value>$amountlimit)
       {
           return false;
       }else{
           return true;
       }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $amountlimit=Account::find($this->accountno)->limitamount;
      $dif=$this->amountwithdraw-$amountlimit;

        return 'You have exceeded your limit amount : You limit is'.$amountlimit.'The excess amount is  .'.$dif;
    }
}
