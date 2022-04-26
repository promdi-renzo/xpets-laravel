<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|  Prettier for php: composer fix-cs
 */

Route::resource("/cart", "CartController")->middleware("auth");
Route::resource("/comment", "CommentsController")->middleware("auth");
Route::resource("/employee", "employeeController")->middleware("auth");
Route::resource("/contact", "ContactController")->middleware("auth");
Route::get("/contact/restore/{id}", [
    "uses" => "ContactController@restore",
    "as" => "contact.restore",
]);
Route::get("/contact/forceDelete/{id}", [
    "uses" => "ContactController@forceDelete",
    "as" => "contact.forceDelete",
]);
Route::get("/review", [ContactController::class, "review"])->name("review");

Route::get("/customer/forceDelete/{id}", [
    "uses" => "CustomerController@forceDelete",
    "as" => "customer.forceDelete",
]);
Route::get("/customer/restore/{id}", [
    "uses" => "CustomerController@restore",
    "as" => "customer.restore",
]);
Route::get("/employee/restore/{id}", [
    "uses" => "employeeController@restore",
    "as" => "employee.restore",
]);
Route::get("/employee/forceDelete/{id}", [
    "uses" => "employeeController@forceDelete",
    "as" => "employee.forceDelete",
]);
Route::get("/service/restore/{id}", [
    "uses" => "ServiceController@restore",
    "as" => "service.restore",
]);
Route::resource("/service", ServiceController::class)->middleware("auth");
Route::get("/service/forceDelete/{id}", [
    "uses" => "ServiceController@forceDelete",
    "as" => "service.forceDelete",
]);
Route::get("/consultation/restore/{id}", [
    "uses" => "ConsultationController@restore",
    "as" => "consultation.restore",
]);
Route::resource("/consultation", ConsultationController::class)->middleware("auth");
Route::get("/consultation/forceDelete/{id}", [
    "uses" => "ConsultationController@forceDelete",
    "as" => "consultation.forceDelete",
]);
Route::get('/results', 'App\Http\Controllers\ConsultationController@results')->name("results")->middleware("auth");
Route::get('/resultss', 'App\Http\Controllers\CustomerController@result')->name("result")->middleware("auth");
Route::resource("/transaction", TransactionController::class)->middleware("auth");
Route::get("/", function () {
    return view("welcome");
});

Route::get('shopping-cart', [
    'uses' => 'App\Http\Controllers\TransactionController@getCart',
    'as' => 'transaction.shoppingCart',
    'middleware' => 'auth',
]);
Route::get('checkout', [
    'uses' => 'TransactionController@postCheckout',
    'as' => 'checkout',
]);
Route::get('/receipt', 'App\Http\Controllers\TransactionController@getReceipt')->name("receipt")->middleware("auth");
Route::get('information', [
    'uses' => 'App\Http\Controllers\TransactionController@getInformation',
    'as' => 'information',
    'middleware' => 'auth',
]);
Route::get('add-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\TransactionController@getAddToCart',
    'as' => 'transaction.addToCart',
]);
Route::get('add-pet/{id}', [
    'uses' => 'App\Http\Controllers\TransactionController@getPet',
    'as' => 'transaction.addPet',
]);
Route::get('remove/{id}', [
    'uses' => 'App\Http\Controllers\TransactionController@getRemoveItem',
    'as' => 'transaction.remove',
]);

Route::resource("/pets", "PetController")->middleware("auth");
Route::get("/pets/restore/{id}", [
    "uses" => "PetController@restore",
    "as" => "pets.restore",
]);
Route::post("/send", [ContactController::class, "send"])->name("send");
Route::resource("/customer", "CustomerController")->middleware("auth");
Route::get("/pets/forceDelete/{id}", [
    "uses" => "PetController@forceDelete",
    "as" => "pets.forceDelete",
]);
Route::get("signup", [
    "uses" => "employeeController@getSignup",
    "as" => "employee.signup",
])->middleware("guest");
Route::post("signup", [
    "uses" => "employeeController@postSignup",
    "as" => "employee.signup",
])->middleware("guest");
Route::get("dashboard", [
    "uses" => "employeeController@Dashboard",
    "as" => "employee.dashboard",
])->middleware("auth");
Route::post("logout", [
    "uses" => "employeeController@getLogout",
    "as" => "employee.logout",
]);
Route::get("logout", [
    "uses" => "employeeController@getLogout",
    "as" => "employee.logout",
]);
Route::post("signin", [
    "uses" => "employeeController@postSignin",
    "as" => "employee.signin",
])->middleware("guest");

Route::get("signin", [
    "uses" => "employeeController@getSignin",
    "as" => "employee.signin",
])->middleware("guest");

Route::post("email", [
    "uses" => "employeeController@Email",
    "as" => "employee.email",
]);
Route::get("email", [
    "uses" => "employeeController@Email",
    "as" => "employee.email",
]);
Route::post("reset", [
    "uses" => "employeeController@Reset",
    "as" => "employee.reset",
]);
Route::get("reset", [
    "uses" => "employeeController@Reset",
    "as" => "employee.reset",
]);
