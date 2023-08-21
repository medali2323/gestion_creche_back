<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepasController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\MediaController;
use App\Http\Controllers\api\EnfantController;
use App\Http\Controllers\api\FamilleController;
use App\Http\Controllers\api\activiteController;
use App\Http\Controllers\api\documentController;
use App\Http\Controllers\PaimentEnfantController;
use App\Http\Controllers\PointageEnfantController;
use App\Http\Controllers\api\inscriptionController;
use App\Http\Controllers\api\anneescolaireController;
use App\Http\Controllers\api\employeEnfantController;
use App\Http\Controllers\api\activiteEnfantController;

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
Route::middleware('auth:sanctum','role:admin')->group( function () {

  
 });
   //Route of enfants
 Route::get('enfants', [EnfantController::class, 'index']);
 Route::get('enfants/{id}', [EnfantController::class, 'getById']);
 Route::get('enfants/{id}/media', [MediaController::class, 'mediaforenfant']);
 Route::get('enfants/{id}/document', [documentController::class, 'documentforenfant']);
 Route::get('enfants/{id}/activite', [activiteEnfantController::class, 'activiteforenfant']);
 Route::get('enfants/{id}/pointage', [PointageEnfantController::class, 'pointageforenfant']);

 Route::post('enfants', [EnfantController::class, 'ajouter']);
 Route::put('enfants/{id}/edit', [EnfantController::class, 'update']);
 Route::delete('enfants/{id}/delete', [EnfantController::class, 'delete']);
 //Route of famille
 
 Route::get('famille', [FamilleController::class, 'index']);
 Route::post('famille', [FamilleController::class, 'ajouter']);
 Route::get('famille/{id}', [FamilleController::class, 'getById']);
 Route::put('famille/{id}/edit', [FamilleController::class, 'update']);
 Route::delete('famille/{id}/delete', [FamilleController::class, 'delete']);
 Route::get('famille/{id}/enfants', [EnfantController::class, 'enfantformamille']);

 //Route of anneescolaire
 
 Route::get('anneescolaire', [anneescolaireController::class, 'index']);
 Route::post('anneescolaire', [anneescolaireController::class, 'ajouter']);
 Route::get('anneescolaire/{id}', [anneescolaireController::class, 'getById']);
 Route::put('anneescolaire/{id}/edit', [anneescolaireController::class, 'update']);
 Route::delete('anneescolaire/{id}/delete', [anneescolaireController::class, 'delete']);
 //Route of inscription
 
 Route::get('inscription', [inscriptionController::class, 'index']);
 Route::post('inscription', [inscriptionController::class, 'ajouter']);
 Route::get('inscription/{id}', [inscriptionController::class, 'getById']);
 Route::put('inscription/{id}/edit', [inscriptionController::class, 'update']);
 Route::delete('inscription/{id}/delete', [inscriptionController::class, 'delete']);

  //Route of Repas
 
  Route::get('Repas', [RepasController::class, 'index']);
  Route::post('Repas', [RepasController::class, 'ajouter']);
  Route::get('Repas/{id}', [RepasController::class, 'getById']);
  Route::put('Repas/{id}/edit', [RepasController::class, 'update']);
  Route::delete('Repas/{id}/delete', [RepasController::class, 'delete']);
 //Route of PaimentEnfant
 
 Route::get('PaimentEnfant', [PaimentEnfantController::class, 'index']);
 Route::post('PaimentEnfant', [PaimentEnfantController::class, 'ajouter']);
 Route::get('PaimentEnfant/{id}', [PaimentEnfantController::class, 'getById']);
 Route::put('PaimentEnfant/{id}/edit', [PaimentEnfantController::class, 'update']);
 Route::delete('PaimentEnfant/{id}/delete', [PaimentEnfantController::class, 'delete']); 
 //Route of document
 
 Route::get('document', [documentController::class, 'index']);
 Route::post('document', [documentController::class, 'ajouter']);
 Route::get('document/{id}', [documentController::class, 'getById']);
 Route::put('document/{id}/edit', [documentController::class, 'update']);
 Route::delete('document/{id}/delete', [documentController::class, 'delete']);

 //Route of media
 
 Route::get('media', [MediaController::class, 'index']);
 Route::post('media', [MediaController::class, 'ajouter']);
 Route::get('media/{id}', [MediaController::class, 'getById']);
 Route::put('media/{id}/edit', [MediaController::class, 'update']);
 Route::delete('media/{id}/delete', [MediaController::class, 'delete']);


 //Route of activites
 Route::get('activites', [activiteController::class, 'index']);
 Route::post('activites', [activiteController::class, 'ajouter']);
 Route::get('activites/{id}', [activiteController::class, 'getById']);
 Route::put('activites/{id}/edit', [activiteController::class, 'update']);
 Route::delete('activites/{id}/delete', [activiteController::class, 'delete']);
//Route of activite_enfant
 
Route::get('activite_enfant', [activiteEnfantController::class, 'index']);
Route::post('activite_enfant', [activiteEnfantController::class, 'ajouter']);
Route::get('activite_enfant/{id}', [activiteEnfantController::class, 'getById']);
Route::put('activite_enfant/{id}/edit', [activiteEnfantController::class, 'update']);
Route::delete('activite_enfant/{id}/delete', [activiteEnfantController::class, 'delete']);


//Route of pointage_enfant
 
Route::get('pointage_enfant', [PointageEnfantController::class, 'index']);
Route::post('pointage_enfant', [PointageEnfantController::class, 'ajouter']);
Route::get('pointage_enfant/{id}', [PointageEnfantController::class, 'getById']);
Route::put('pointage_enfant/{id}/edit', [PointageEnfantController::class, 'update']);
Route::delete('pointage_enfant/{id}/delete', [PointageEnfantController::class, 'delete']);

//Route of employe_enfant
 
Route::get('employe_enfant', [employeEnfantController::class, 'index']);
Route::post('employe_enfant', [employeEnfantController::class, 'ajouter']);
Route::get('employe_enfant/{id}', [employeEnfantController::class, 'getById']);
Route::put('employe_enfant/{id}/edit', [employeEnfantController::class, 'update']);
Route::delete('employe_enfant/{id}/delete', [employeEnfantController::class, 'delete']);
// register ,login,logout
 Route::post('/auth/logout', [UserController::class, 'logout']);
 Route::post('/auth/register', [UserController::class, 'createUser']);
 Route::post('/auth/login', [UserController::class, 'loginUser']);

