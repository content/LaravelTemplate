<?php

use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

// Routes will call the corresponding methods in the FamilyController when accessed.

// This route will display the family index page when accessed via a GET request to /family.
Route::get('/family', [FamilyController::class, 'index']);

// This route will handle the POST request to create a new family. 
// The create method in the FamilyController will process the request and return a JSON response with the details of the newly created family.
Route::post('/family/create', [FamilyController::class, 'create']);

// In this case {id} is a placeholder for the family ID you want to retrieve. 
// This will be passed as a parameter to the get method in the FamilyController.
Route::get('/family/{id}', [FamilyController::class, 'get']);

Route::delete('/family/delete/{id}', [FamilyController::class, 'delete']);