<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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


Route::get('/about',function(){
    return view('front.about');
})->name('about');


                    /*********** Front Pages ************/
Route::get('/',[FrontController::class,'index'])->name('homepage');
Route::get('/category/product/{id}',[FrontController::class,'show'])->name('product.show');
Route::get('/category/{id}',[FrontController::class,'showCategory'])->name('category.show');

            /*******  Book Or Buy Product with Details of User ********/
Route::prefix('/category/product/{id}')->middleware(['auth','phoneVerify'])->group(function () {
    Route::get('/completeData',[FrontController::class,'showMoreDetails'])
            ->middleware('isDetailed')
            ->name('category.showMoreDetails');
    Route::post('/complete-data',[FrontController::class,'completeData'])
            ->name('category.completeData');
    Route::post('/storeDetails',[FrontController::class,'storeDetails'])
                ->name('category.storeDetails');
    Route::get('/buy-or-book',[FrontController::class,'buyOrBook'])
                ->name('category.buyOrBook');

    Route::get('/book',[FrontController::class,'book'])
                ->name('category.book');

    Route::post('/buy',[FrontController::class,'buy'])
            ->name('category.buy');
});




Auth::routes();
                    /*********** Facebook Login ************/
Route::get('/facebook/redirect', [FacebookController::class,'redirect'])->name('facebook.redirect')->middleware('isVerified');
Route::get('/facebook/callback', [FacebookController::class,'callback'])->name('facebook.callback')->middleware('isVerified');
Route::prefix('facebook')->name('facebook.')->middleware(['auth','isVerified'])->group(function(){
    Route::get('phone', [FacebookController::class,'phone'])->name('phone');
    Route::post('phone', [FacebookController::class,'store'])->name('store');
});

                    /***********  Mobile Verification ************/
Route::prefix('phone/verify')->name('verify.')->middleware(['auth','isVerified'])->group(function(){
    Route::get('/',[App\Http\Controllers\Auth\VerifyPhoneController::class,'index'])->name('phone');
    Route::get('send',[App\Http\Controllers\Auth\VerifyPhoneController::class,'sendCode'])->name('sendCode');
    Route::Post('/',[App\Http\Controllers\Auth\VerifyPhoneController::class,'verify'])->name('phone.send');
    Route::delete('/delete',[App\Http\Controllers\Auth\VerifyPhoneController::class,'reRegister'])->name('reRegister');
});
// Users
Route::prefix('/profile')->name('profile.')->group(function(){
    Route::get('/',[App\Http\Controllers\UserController::class,'index'])->name('index');
    Route::get('/{id}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('edit');
    Route::put('/{id}/update',[App\Http\Controllers\UserController::class,'update'])->name('update');
    Route::get('/create-details',[App\Http\Controllers\UserController::class,'create'])->name('create');
    Route::post('/store-details',[App\Http\Controllers\UserController::class,'store'])->name('store');
    Route::get('/{id}/products',[App\Http\Controllers\UserController::class,'products'])->name('products');
    Route::delete('/{id}/products-destroy',[App\Http\Controllers\UserController::class,'destoryProduct'])->name('product-destroy');


    
});
//Front Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/***************************************************************************************************/

                /******************* Admin Routes ************************/
Route::prefix('admin')->middleware(['auth','isAdmin','can:admin'])->name('admin.')->group(function () {
    Route::get('/',[App\Http\Controllers\Admin\AdminController::class,'index'])->name('index');
    
    Route::resource('/users', App\Http\Controllers\Admin\AdminUsersController::class)->except(['show']);
    
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
                      /*********** User - Products ************/
    Route::get('/users/products/{id}', [App\Http\Controllers\Admin\AdminUsersController::class,'showProducts'])->name('users.showProducts');
    Route::get('/users/products/{id}/{product_id}', [App\Http\Controllers\Admin\AdminUsersController::class,'showProductPictures'])->name('users.showProductPictures');
    Route::delete('/users/products/{id}/{product}', [App\Http\Controllers\Admin\AdminUsersController::class,'destroyProduct'])->name('users.destroyProduct');
                     /*********** Categories - Products ************/
    Route::resource('/category/{cat}/products', App\Http\Controllers\Admin\AdminProductsController::class)->except('show');

                     /*********** Product - Details ************/
    Route::get('/products/pictures/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'showPictures'])->name('products.showPictures');
    Route::get('/products/sizes/{id}/create', [App\Http\Controllers\Admin\AdminProductsController::class,'createSizes'])->name('products.createSizes');
    Route::post('/products/sizes/{id}/store', [App\Http\Controllers\Admin\AdminProductsController::class,'storeSizes'])->name('products.storeSizes');
    Route::get('/products/sizes/{id}/', [App\Http\Controllers\Admin\AdminProductsController::class,'showSizes'])->name('products.showSizes');
    Route::get('/products/sizes/{id}/edit/{size}', [App\Http\Controllers\Admin\AdminProductsController::class,'editSizes'])->name('products.editSizes');
    Route::post('/products/sizes/{id}/update/{size}', [App\Http\Controllers\Admin\AdminProductsController::class,'updateSizes'])->name('products.updateSizes');
    Route::delete('/products/sizes/{id}/destroy/{size}', [App\Http\Controllers\Admin\AdminProductsController::class,'destroySizes'])->name('products.destroySizes');
    Route::put('/products/pictures/{id}', [App\Http\Controllers\Admin\AdminProductsController::class,'updatePictures'])->name('products.updatePictures');
    Route::delete('/products/pictures/{id}/{image}', [App\Http\Controllers\Admin\AdminProductsController::class,'deleteProduct'])->name('products.deleteProduct');
                   
                     /*********** Orders  ************/
    Route::get('orders', [App\Http\Controllers\Admin\AdminController::class,'showOrders'] )->name('showOrders');

});
