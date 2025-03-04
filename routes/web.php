<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome')->middleware("auth");
});
*/
use Illuminate\Support\Facades\DB;
use App\Product;
/*
Route::get('/hello', function () {
    //return view('welcome');
    return '<h1>Hello World</h1>';
});

Route::get('/users/{id}/{name}', function ($id,$name) {
    return 'This is user '.$name.' with an id of '.$id;
});


*/
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/', 'PagesController@index');
//Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts','PostsController');
Route::resource('categories','CategoriesController');





Auth::routes();
Route::get('/posts/{id}/{slug}','PostsController@show');
Route::get('/dashboard', 'DashboardController@index');


Route::get('/tests', function(){


    return 'test';




});
Auth::routes();
Route::get('/product/{productid}','Product\ProductController@showProductById')->name('showThisProduct');
Route::post('/notificationUpdate/{notificationid}','NotificationController@edit')->name('showproduct');
//Route::post('/orders', 'Order\OrderController@orders')->middleware('auth');
Route::get('/myorders','Order\OrderItemController@index')->name('myorders')->middleware('auth');

Route::get('/ordersitems','Order\OrderItemController@index')->name('orders')->middleware('auth');
Route::get('/invoice','Invoice\InvoiceController@index')->middleware('auth');
Route::get('/invoice/{orderid}','Invoice\InvoiceController@invoicestream')->middleware('auth');


Route::get('/accounts','AccountController@index')->name('accounts');
Route::get('/','HomeController@index');
Route::get('/orderitems/{orderid}','Order\OrderItemController@orderitems')->name('ordersitems')->middleware('auth');;
Route::get('/test','Invoice\InvoiceController@test');
Route::get('/product/{id}','Product\ProductController@edit')->middleware('auth');;
//Route::resources();
Route::post('editproduct','Product\ProductController@update')->name('editproduct')->middleware('auth');;

Route:: get('/buy',function(){

    $products=DB::table('products')->get();

    return view('product.products',compact('products'));

})->name('buy')->middleware('auth');

/**
*
 *
 * Report
 *
 */

Route::get('/transactionspdf/{accountno}','TransactionController@topdf')->name('statementaccount')->middleware('auth');


//***********************************invoices**********************

Route::post('buyselected', 'OrderController@index')->middleware('auth');;
Route::post('/orders', 'OrderController@orders')->middleware('auth');;
Route::get('/transaction/{id?}','TransactionController@index')
    ->name('transactionview')
    ->middleware('auth');
Route::get('/trackorder','Order\OrderTrackController@track')->middleware('auth');
Route::post('/trackorder','Order\OrderTrackController@tracksave')->name('setorderstatus')->middleware('auth');


Route::get('/home/view','HomeController@view')->name('homeview')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/uploadprofile','Auth\ChangeProfileController@index')->name('uploadprofile')->middleware('auth');
Route::post('/uploadmyprofile','Auth\ChangeProfileController@upload')->name('upload')->middleware('auth');;
Route::get('transfers','AccountController@transfers')->name('transfers')->middleware('auth');
Route::post('transferred','AccountController@transferred')->name('transferred')->middleware('auth');
Route::get('/deposit','AccountController@depositshow')->name('depositMoney')->middleware('auth');
Route::post('/deposit','AccountController@deposit')->name('deposit')->middleware('auth');
Route::get('/withdraw','AccountController@withdrawshow')->name('withdrawMoney')->middleware('auth');
Route::post('/withdraw','AccountController@withdraw')->name('withdraw')->middleware('auth');
Route::get('/setting', 'Setting\SettingController@set')->name('setting')->middleware('auth');
Route::post('setting','Setting\SettingController@setting')->name('setsetting')->middleware('auth');
Route::get('/registerproduct',function(){
    $status=null;
    return view('product.registerproduct',compact('status'));
})->name('registerproduct')->middleware('auth');


Route::post('/addproduct','Product\ProductController@store')
              ->name('addproduct')
              ->middleware('admins');

Route::get('/adduseraddress',function(){

    return view('user.useraddress');

})->name('adduseraddress')->middleware('auth');

Route::post('/adduseraddress',"UserAddressController@store")->name('saveuseraddress')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('ajaxRequest', 'HomeController@ajaxRequest');

Route::post('ajax', 'HomeController@ajaxRequestPost')->name('ajax');








