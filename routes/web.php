<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\OrderContrloller;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware("locale")->group(function () {
    Route::get('/', [AppController::class, "mainIndex"])->name("app.main");
    Route::get("lang/{lang}", [AppController::class, "changeLocale"])->name("app.change-lang");
    Route::get("products/{productSlug}", [AppController::class, "show"])->name("products.show");

    Route::get("add-to-cart/{product}", [CartController::class, 'addToCart'])->name('cart.add-product');
    Route::get("cart", [CartController::class, 'cartPage'])->name('cart');
    Route::put("cart/items/{item}/edit", [CartController::class, 'changeQty'])->name('cart.items.qty-update');

    Route::delete("cart/items/{item}", [CartController::class, 'destroy'])->name('cart.items.destroy');

    Route::get('catalog/{category}', [AppController::class, 'getProductsByCategories'])->name('app.catalog-by-category');

    Route::post('cart/set-promocode', [CartController::class, 'applyPromocode'])->name('cart-apply-promocode');
    Route::get('cart/unset-promocode', [CartController::class, 'cancelPromocode'])->name('cart-cancel-promocode');

    Route::middleware(["auth"])->group(function () {
        //категории
        Route::prefix("categories")->middleware('role:super-admin|admin|moderator')->group(function () {
            Route::get("/", [CategoryController::class, "categoriesList"])->name("categoriesList");
            Route::get("create", [CategoryController::class, "createCategory"])->name("categories.create");
            Route::post("create", [CategoryController::class, "storeCategory"])->name("categories.store");
            Route::get("{categoryId}/edit", [CategoryController::class, "editCategory"])->name("categories.edit");
            Route::put("{categoryId}/edit", [CategoryController::class, "updateCategory"])->name("categories.update");
            Route::delete("{categoryId}", [CategoryController::class, "deleteCategory"])->name("categories.delete");
        });

        //Товары
        Route::prefix("products")->middleware('role:super-admin|admin|moderator')->group(function () {
            Route::get("/", [ProductController::class, "index"])->name("products.index");
            Route::get("create/add", [ProductController::class, "create"])->name("products.create");
            Route::post("create", [ProductController::class, "store"])->name("products.store");
            Route::get("{productId}/edit", [ProductController::class, "edit"])->name("products.edit");
            Route::put("{productId}/edit", [ProductController::class, "update"])->name("products.update");
            Route::delete("{productId}", [ProductController::class, "delete"])->name("products.delete");
            Route::get("{productId}/remove-image", [ProductController::class, "removeImage"])->name("products.remove-image");
        });
        //Состояние
        Route::resource('conditions', ConditionController::class)->middleware('role:super-admin|admin|moderator');


        //Пользователи
        Route::prefix("users")->middleware('role:super-admin|admin')->group(function () {
            Route::get("/", [UserController::class, "index"])->name("users.index");
            Route::get("{user}/edit", [UserController::class, "edit"])->name("users.edit");
            Route::put("{user}/edit", [UserController::class, "update"])->name("users.update");
        });

        //Роли
        Route::prefix("roles")->middleware('role:super-admin')->group(function () {
            Route::get("/", [RoleController::class, "index"])->name("roles.index");
            Route::get("create", [RoleController::class, "create"])->name("roles.create");
            Route::post("create", [RoleController::class, "store"])->name("roles.store");
            Route::get("{role}/edit", [RoleController::class, "edit"])->name("roles.edit");
            Route::put("{role}/edit", [RoleController::class, "update"])->name("roles.update");
        });

        //Права
        Route::prefix("permissions")->middleware('role:super-admin')->group(function () {
            Route::get("/", [PermissionController::class, "index"])->name("permissions.index");
            Route::get("create", [PermissionController::class, "create"])->name("permissions.create");
            Route::post("create", [PermissionController::class, "store"])->name("permissions.store");
        });

        //Заказы
        Route::get('checkout', [OrderContrloller::class, "checkoutPage"])->name("app.checkout");
        Route::post('checkout', [OrderContrloller::class, "storeOrder"])->name("app.storeOrder");
        Route::get('order/{order}/thankyou', [OrderContrloller::class, "thankyouPage"])->name("app.order-thankyou");

        Route::get("orders", [OrderContrloller::class, "orders"])->name("admin.orders");

        Route::post("logout", [AuthController::class, "logout"])->name("auth.logout");

        Route::prefix("admin")->group(function(){
            Route::resource('orders', AdminOrderController::class);


            Route::get('change-order-status/{order}', [AdminOrderController::class, "changeStatus"])->name("order.change-status");
        });
    });

    //Middleware
    Route::middleware("guest")->group(function () {
        Route::get("register", [AuthController::class, "registerPage"])->name("auth.register");
        Route::post("register", [AuthController::class, "storeUser"])->name("auth.store-user");
        Route::get("login", [AuthController::class, "loginPage"])->name("auth.loginPage");
        Route::post("login", [AuthController::class, "login"])->name("auth.login");
    });
    
});
