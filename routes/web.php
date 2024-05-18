<?php

use Illuminate\Support\Facades\Route;

// Custom controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SlotsController;

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

Route::get('/', function () {
    return redirect()->route("auth.login");
});

Route::group(["prefix" => "auth"], function() {

    // GET routes
    Route::get("/login", function() {
        return view("login");
    })->name("auth.login");

    Route::get("/register", function() {
        return view("register");
    })->name("auth. ");

    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
    
    // POST routes
    Route::post("/login", [AuthController::class, "login"])->name("login.post");
    Route::post("/register", [AuthController::class, "register"])->name("register.post");

});

Route::group(["prefix" => "dashboard", "middleware" => "auth"], function() {

    // GET routes
    Route::get("/", function() {
        return view("welcome");
    })->name("dashboard.index");

});

Route::group(["prefix" => "slots", "middleware" => "auth"], function() {

    // GET routes
    Route::get("/", function() {
        return view("slots");
    })->name("slots.index");

    Route::post("/take-slot", [SlotsController::class, "take_slot"]);

});

Route::group(["prefix" => "admin", "middleware" => ["auth", "isAdmin"]], function() {

    // GET routes
    Route::get("/", function() {
        return view("admin_slots");
    })->name("admin.slots.index");

    Route::get("/get-all-slots", [SlotsController::class, "allEvents"]);

    Route::post("/add-slot", [SlotsController::class, "add_slot"]);
    Route::post("/remove-slot", [SlotsController::class, "remove_slot"]);


});
