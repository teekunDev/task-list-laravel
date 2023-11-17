<?php

use Illuminate\Support\Facades\Route;

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
    return 'Main Page';
});

Route::get('/hello', function() {
  return redirect()->route('bye');
})->name('hello');

Route::get('/bye', function() {
  return redirect()->route('hello');
})->name('bye');

Route::get('/yes', function() {
  return 'yes';
});





Route::get('/fuck/{name}', function($name) {
  return "kill {$name}";
});  