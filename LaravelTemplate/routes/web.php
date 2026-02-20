<?php

use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

// Routes will call the corresponding methods in the FamilyController when accessed.

// This route will display the family index page when accessed via a GET request to /family.

// The name method is used to give this route a name, which can be used when generating URLs or redirects in the application.
// For example you may now use route('family') to generate the URL for this route instead of hardcoding it. 
// This can be helpful if you ever need to change the URL structure in the future, as you would only need to update it in one place.
Route::get('/family', [FamilyController::class, 'index'])->name('family');

// This route will handle the POST request to create a new family. 
// The create method in the FamilyController will process the request and return a JSON response with the details of the newly created family.
Route::post('/family/create', [FamilyController::class, 'create']);

// In this case {id} is a placeholder for the family ID you want to retrieve. 
// This will be passed as a parameter to the get method in the FamilyController.
Route::get('/family/{id}', [FamilyController::class, 'get']);

Route::delete('/family/delete/{id}', [FamilyController::class, 'delete']);
Route::post('/family/update/{id}', [FamilyController::class, 'update'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Using middleware('auth') to protect the dashboard route, ensuring that only authenticated users can access it.
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');