<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\diseaseInjuryController;
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
Route::post("/send", [ContactController::class, "send"])->name("send");

Route::resource("/pets", "PetController")->middleware("auth");
Route::get("/pets/restore/{id}", [
    "uses" => "PetController@restore",
    "as" => "pets.restore",
]);
Route::get("/pets/forceDelete/{id}", [
    "uses" => "PetController@forceDelete",
    "as" => "pets.forceDelete",
]);

Route::resource("/customer", "CustomerController")->middleware("auth");
//Route::resource("/customer", CustomerController::class);
Route::get("/customer/restore/{id}", [
    "uses" => "CustomerController@restore",
    "as" => "customer.restore",
]);
Route::get("/customer/forceDelete/{id}", [
    "uses" => "CustomerController@forceDelete",
    "as" => "customer.forceDelete",
]);

Route::resource("/diseaseinjury", diseaseInjuryController::class)->middleware(
    "auth"
);
Route::get("/diseaseinjury/restore/{id}", [
    "uses" => "diseaseInjuryController@restore",
    "as" => "diseaseinjury.restore",
]);
Route::get("/diseaseinjury/forceDelete/{id}", [
    "uses" => "diseaseInjuryController@forceDelete",
    "as" => "diseaseinjury.forceDelete",
]);

Route::resource("/personnel", "personnelController")->middleware("auth");
Route::get("/personnel/restore/{id}", [
    "uses" => "personnelController@restore",
    "as" => "personnel.restore",
]);
Route::get("/personnel/forceDelete/{id}", [
    "uses" => "personnelController@forceDelete",
    "as" => "personnel.forceDelete",
]);

Route::resource("/service", ServiceController::class)->middleware("auth");
Route::get("/service/restore/{id}", [
    "uses" => "ServiceController@restore",
    "as" => "service.restore",
]);
Route::get("/service/forceDelete/{id}", [
    "uses" => "ServiceController@forceDelete",
    "as" => "service.forceDelete",
]);

Route::resource("/consultation", ConsultationController::class)->middleware("auth");
Route::get("/consultation/restore/{id}", [
    "uses" => "ConsultationController@restore",
    "as" => "consultation.restore",
]);
Route::get("/consultation/forceDelete/{id}", [
    "uses" => "ConsultationController@forceDelete",
    "as" => "consultation.forceDelete",
]);
//Route::get('/search', 'App\Http\Controllers\ConsultationController@search')->name("search")->middleware("auth");
//Route::get("/search", [ConsultationController::class, "search"])->name("search");
Route::get('/results', 'App\Http\Controllers\ConsultationController@results')->name("results")->middleware("auth");
//Route::get("/result", [ConsultationController::class, "result"])->name("result");
Route::get('/result', 'App\Http\Controllers\CustomerController@result')->name("result")->middleware("auth");

Route::resource("/transaction", TransactionController::class)->middleware("auth");

Route::get("/", function () {
    return view("welcome");
});

Route::get("signup", [
    "uses" => "personnelController@getSignup",
    "as" => "personnel.signup",
])->middleware("guest");

Route::post("signup", [
    "uses" => "personnelController@postSignup",
    "as" => "personnel.signup",
])->middleware("guest");

Route::get("dashboard", [
    "uses" => "personnelController@Dashboard",
    "as" => "personnels.dashboard",
])->middleware("auth");

Route::post("logout", [
    "uses" => "personnelController@getLogout",
    "as" => "personnel.logout",
]);

Route::get("logout", [
    "uses" => "personnelController@getLogout",
    "as" => "personnel.logout",
]);

Route::post("signin", [
    "uses" => "personnelController@postSignin",
    "as" => "personnel.signin",
])->middleware("guest");

Route::get("signin", [
    "uses" => "personnelController@getSignin",
    "as" => "personnel.signin",
])->middleware("guest");

Route::post("email", [
    "uses" => "personnelController@Email",
    "as" => "personnel.email",
]);

Route::get("email", [
    "uses" => "personnelController@Email",
    "as" => "personnel.email",
]);

Route::post("reset", [
    "uses" => "personnelController@Reset",
    "as" => "personnel.reset",
]);

Route::get("reset", [
    "uses" => "personnelController@Reset",
    "as" => "personnel.reset",
]);

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

Route::get('data', [
    'uses' => 'App\Http\Controllers\TransactionController@getData',
    'as' => 'data',
    'middleware' => 'auth',
]);

Route::get('add-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\TransactionController@getAddToCart',
    'as' => 'transaction.addToCart',
]);

Route::get('add-animal/{id}', [
    'uses' => 'App\Http\Controllers\TransactionController@getAnimal',
    'as' => 'transaction.addAnimal',
]);

Route::get('remove/{id}', [
    'uses' => 'App\Http\Controllers\TransactionController@getRemoveItem',
    'as' => 'transaction.remove',
]);
