<?php
/*
 * Author: Donald Tutani
 * The Policy ensures that only administrators can add or delete
 * product(s).
 */
namespace App\Policies;

use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /*
     * A user can add a new product if he/she has administrator role
     */
    public function store(User $user)
    {
        if($user->roles()->where('rolename','admin')
                ->count()>0)
        {
            return true;
        }else{
            return false;
        }
    }

    /*
     * A user can delete a  product if he/she has an administrator role
    */
    public function delete(User $user, Product $product)
    {
        if($user->roles()->where('rolename','admin')
                ->count()>0)
        {
            return true;
        }else{
            return false;
        }
    }
}
