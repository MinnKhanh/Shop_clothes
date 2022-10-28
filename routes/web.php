<?php

use App\Events\RegisterEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SystemConfigController;
use App\Http\Controllers\Testcontroller;
use App\Http\Controllers\UserController;
use App\Jobs\SendEmail;
use App\Models\Discount;
use App\Models\Img;
use App\Models\Introduce;
use App\Models\Orders;
use App\Models\ProductDetail;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('index');
Route::group([
    'as'     => 'product.',
    'prefix' => 'product',
], static function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/list-product', [ProductController::class, 'getProductBy'])->name('listproduct');
    Route::get('/product-detail', [ProductController::class, 'getProductDetail'])->name('productdetail');
    Route::get('/getsizeandimg', [ProductController::class, 'getSizeAndImg'])->name('getsizeandimg');
    Route::get('/add-faverite', [ProductController::class, 'addFaverite'])->name('addfaverite');
    Route::get('/remove-faverite', [ProductController::class, 'removeFaverite'])->name('removefaverite');
    Route::post('/rate-product', [ProductController::class, 'rateProduct'])->name('rateproduct');
    Route::get('/view-favorite', [ProductController::class, 'viewFavorite'])->name('viewfavorite')->middleware('auth');
});
Route::group([
    'as'     => 'cart.',
    'prefix' => 'cart',
], static function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::get('/addtocart', [CartController::class, 'AddToCart'])->name('addtocart');
    Route::get('/removecart', [CartController::class, 'removeCart'])->name('removecart');
    Route::get('/changecart', [CartController::class, 'changeCart'])->name('changecart');
    Route::get('/removeproductincart', [CartController::class, 'removeProductInCart'])->name('removeproductincart');
    Route::get('/getdiscount', [CartController::class, 'getDiscount'])->name('getdiscount');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
    Route::post('/checkout', [OrderController::class, 'CreateOrder'])->name('checkout');
});
Route::group([
    'as'     => 'orders.',
    'prefix' => 'orders',
    'middleware' => 'auth'
], static function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/detail', [OrderController::class, 'OrderDetail'])->name('detail');
    Route::delete('/delete', [OrderController::class, 'delete'])->name('delete');
    Route::post('/updateinfor', [OrderController::class, 'updateInfor'])->name('updateinfor');
    Route::delete('/deletedetail', [OrderController::class, 'deleteDetail'])->name('deletedetail');
    Route::post('/update-order', [OrderController::class, 'updateOrder'])->name('updateorder');
    Route::get('/reject', [OrderController::class, 'rejectUpdate'])->name('reject');
    Route::put('/updatestatus', [OrderController::class, 'updateStatus'])->name('updatestatus');
    Route::get('/export', [OrderController::class, 'Export'])->name('export');
    Route::get('/redirect-to-list', [OrderController::class, 'redirectToList'])->name('redirecttolist');
    Route::get('/print', [OrderController::class, 'ExportDetail'])->name('print');
});
Route::group([
    'as'     => 'auth.',
    'prefix' => 'auth',
], static function () {
    Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('checklogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registering', [AuthController::class, 'registering'])->name('registering');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::get('/update-account', [AuthController::class, 'updateAccont'])->name('updateaccont');
    Route::post('/update', [AuthController::class, 'update'])->name('update');
    Route::post('/send-confirm', [AuthController::class, 'sendConfirm'])->name('sendconfirm');
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('resetpassword');
    Route::get('/fogotpassword', [AuthController::class, 'forgotPassword'])->name('fogotpassword');
    Route::post('/update-by-email', [AuthController::class, 'updateByEmail'])->name('updatebyemail');
});
Route::group([
    'as'     => 'user.',
    'prefix' => 'user',
    'middleware' => 'auth'
], static function () {
    Route::post('/', [UserController::class, 'index'])->name('index');
    Route::put('/updateinfo', [UserController::class, 'updateInfo'])->name('updateinfo');
    Route::get('/contact', [UserController::class, 'conTact'])->name('contact');
    Route::post('/send-message', [UserController::class, 'sendMessage'])->name('sendmessage');
});
Route::group([
    'as'     => 'discount.',
    'prefix' => 'discount',
], static function () {
    Route::post('/add-to-account', [DiscountController::class, 'addToAccount'])->name('addtoaccount');
});
Route::group([
    'as'     => 'test.',
    'prefix' => 'test',
], static function () {
    // Route::get('/', [Testcontroller::class, 'index'])->name('index');
    // Route::post('/import', [Testcontroller::class, 'import'])->name('import');
    Route::get('/', function () {
        $product = Products::join('product_detail', 'products.id', 'product_detail.id_product')
            ->join('product_size', 'product_detail.id', 'product_size.id_productdetail')
            ->join('color', 'color.id', 'product_detail.id_color')
            ->join('size', 'size.id', 'product_size.size')
            ->leftjoin('discount', 'discount.relation_id', 'products.id')
            ->join('imgs', 'imgs.product_id', 'products.id')->where('imgs.type', 1)
            ->select(
                'products.name',
                'products.id',
                DB::raw(
                    "if(discount.begin <= '" . Carbon::now()->format('Y-m-d') . "' && discount.end >= '" . Carbon::now()->format('Y-m-d') . "',products.price_discount,products.priceSell) as price"
                ),
                DB::raw(
                    'imgs.path as img'
                ),
                DB::raw('products.code'),
                DB::raw('product_detail.id_color'),
                DB::raw('color.name as namecolor'),
                DB::raw('product_size.quantity'),
                DB::raw('product_size.size as idsize'),
                DB::raw('product_detail.id as idProductDetail'),
                DB::raw('size.name as namesize'),
            )->first()->toArray();
        dd($product);
    })->name('put');
});
Route::get('auth/{social}', [AuthController::class, 'redirectToProvider'])->name('social');
Route::get('auth/{social}/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('chinh-sach-quyen-rieng-tu', function () {
    return '<h1>Chinh sach quyen rieng tu<h1>';
});

Route::get('clear', function () {
    Artisan::call('cache:clear');
});
