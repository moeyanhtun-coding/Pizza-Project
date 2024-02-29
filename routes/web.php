<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\pizzaContorller;
use App\Http\Controllers\User\pizzaController;

Route::middleware(["authAdmin"])->group(function () {
    // login , register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    Route::get('deshboard', [AuthController::class, 'deshboard'])->name('auth#deshboard');

    //admin
    Route::middleware(['authAdmin'])->group(function () {
        Route::prefix('category')->group(function () {
            // category
            Route::get('list', [CategoryController::class, 'categoryList'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'categoryCreate'])->name('category#createPage');
            Route::post('createList', [CategoryController::class, 'create'])->name('create#list');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        // admin Account
        Route::prefix('admin')->group(function () {

            // change Password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('change#passwordPage');
            Route::post('password/change', [AdminController::class, 'changePassword'])->name('change#password');

            // account CRUD
            Route::get('profile/detail/{id}', [AdminController::class, 'accountDetail'])->name('adminAccount#detail');
            Route::get('profile/edit/{id}', [AdminController::class, 'edit'])->name('account#editAdmin');
            Route::post('account/detail/update/{id}', [AdminController::class, 'updateDetails'])->name('update#detail');

            // admin list
            Route::get('list', [AdminController::class, 'list'])->name('account#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('list#delete');
            Route::get('change/role/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}', [AdminController::class, 'change'])->name('change#role');
            Route::get('role/change', [AjaxController::class, 'roleChange'])->name('ajax#changeRole');

            // user list
            Route::get('users/list', [AdminController::class, 'usersList'])->name('users#list');
            Route::get('users/list/view/{id}', [AdminController::class, 'usersListView'])->name('userList#view');
            Route::get('users/list/edit/{id}', [AdminController::class, 'userListEdit'])->name('userList#edit');
            Route::post('users/list/update/{id}', [AdminController::class, 'userListUpdate'])->name('userList#update');
            Route::get('users/list/delete/{id}', [AdminController::class, 'userListDelete'])->name('userList#delete');

            // contact list
            Route::get('contact/list', [AdminController::class, 'contactList'])->name('contact#list');
            Route::get('contact/list/detail/{id}', [AdminController::class, 'contactDetail'])->name('contact#detail');
        });
        Route::prefix('product')->group(function () {
            Route::get('list', [ProductController::class, 'listPage'])->name('product#list');
            Route::get('create', [ProductController::class, 'productCreate'])->name('create#page');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail#page');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit#page');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('update#page');
        });
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'orderList'])->name('order#list');
            Route::get('list/status', [OrderController::class, 'orderStatus'])->name('order#status');
            Route::get('status/change', [OrderController::class, 'statusChange'])->name('status#change');
            Route::post('status/search', [OrderController::class, 'statusSearch'])->name('status#search');
            Route::get('product/list/{order_code}', [OrderController::class, 'productList'])->name('product#orderList');
        });
    });


    //user
    Route::group(['prefix' => 'user', 'middleware' => 'authUser'], function () {
        Route::get('home', [UserController::class, 'home'])->name('user#home');
        Route::get('category/filter/{id}', [UserController::class, 'filter'])->name('pizza#filter');
        Route::get('history/order', [UserController::class, 'history'])->name('history#order');
        Route::get('contact/us', [UserController::class, 'contactUs'])->name('contact#us');
        Route::post('contact/us/send', [UserController::class, 'contactSend'])->name('contactUs#send');

        //account function

        Route::group(['prefix' => 'account'], function () {
            Route::get('changePassword', [UserController::class, 'changePasswordPage'])->name('passwordChange#page');
            Route::get('detail/{id}', [UserController::class, 'detail'])->name('account#detail');
            Route::get('account/update/{id}', [UserController::class, 'updateAccount'])->name('account#update');
            Route::post('account/edit/{id}', [UserController::class, 'updateData'])->name('account#edit');
        });

        Route::group(['prefix' => 'pizza'], function () {
            Route::get('cart', [pizzaController::class, 'pizzaCart'])->name('item#cart');
            Route::get('detail/{id}', [pizzaController::class, 'pizzaDetail'])->name('item#detail');
        });

        Route::group(['prefix' => 'ajax'], function () {
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('pizza#list');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('pizza#addtocart');
            Route::get('order', [AjaxController::class, 'orderConfirm'])->name('order#confirm');
            Route::get('order/cancel', [AjaxController::class, 'orderCancel'])->name('order#Cancel');
            Route::get('row/delete', [AjaxController::class, 'rowDelete'])->name('row#delete');
            Route::get('viewCount/increase', [AjaxController::class, 'viewCount'])->name('view#count');
        });
    });
});
