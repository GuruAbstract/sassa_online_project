<?php

namespace App\Http\Controllers\Setting;


use App\Account;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public  function set()
    {
        $accountnos=DB::table('accounts')
            ->where('accounts.id','=',Auth::id())
            ->select('accountno')
            ->get();

        return view('setting',compact('accountnos'));

    }
    public  function setting(Request $request)
    {
        $request->input('isuserdeliveryaddress');
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

        if($dailylimit>0)
        {
            $account->dailylimit=$dailylimit;
            $account->save();
        }
        if($limitamount>0)
        {
            $account->limitamount=$limitamount;
            $account->save();
        }

        if($isuserdeliveryaddress!='null')
        {

            UserAddress::where('id',Auth::id())
                ->update(['isuserdeliveryaddress'=>0]);

             UserAddress::where('useraddressid',$isuserdeliveryaddress)
             ->update(['isuserdeliveryaddress'=>1]);

        }

            return redirect('/home');

    }









    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
