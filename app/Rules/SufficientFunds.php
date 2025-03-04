<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Account;
class SufficientFunds implements Rule
{
     private $accountfrom=0;
     private $accountto=0;
     private $amount=0;

    public function __construct($accountfrom,$accountto,$amount)
    {
       $this->accountto=$accountto;
       $this->accountfrom=$accountfrom;
       $this->amount=$amount;
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
        $account=Account::find($this->accountfrom);
        if($account->balance<$value)
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
        $difference=$this->amount-$account=Account::find($this->accountfrom)->balance;
        return 'You have insufficient funds for this transaction--short fall of R'.$difference;
    }
}
