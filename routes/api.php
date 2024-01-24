<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// importo il controller project ma della cartella api
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// la route è identica a quella web
// se digitassi sul browser http://127.0.0.1:8000/api/projects mi mostrerebbe la pagina col json
Route::get('projects', [ProjectController::class, 'index']);

// creiamo la rotta dello show
// se digitassi sul browser http://127.0.0.1:8000/api/projects/1 mi mostrerebbe
// la pagina col json del primo elemento in projects
Route::get('projects/{slug}', [ProjectController::class, 'show']);

Route::get('categories', [CategoryController::class, 'index']);

Route::get('categories/{slug}', [CategoryController::class, 'show']);

Route::get('technologies', [TechnologyController::class, 'index']);

Route::get('technologies/{slug}', [TechnologyController::class, 'show']);
