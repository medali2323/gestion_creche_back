<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TvaController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CongeController;
use App\Http\Controllers\api\MediaController;
use App\Http\Controllers\api\RepasController;
use App\Http\Controllers\api\SalleController;
use App\Http\Controllers\api\EnfantController;
use App\Http\Controllers\api\AbsenceController;
use App\Http\Controllers\api\DortoirController;
use App\Http\Controllers\api\employeController;
use App\Http\Controllers\api\FactureController;
use App\Http\Controllers\api\FamilleController;
use App\Http\Controllers\api\activiteController;
use App\Http\Controllers\api\documentController;
use App\Http\Controllers\api\inscriptionController;
use App\Http\Controllers\api\ModePaimentController;
use App\Http\Controllers\api\RepasEnfantController;
use App\Http\Controllers\api\DemandeCongeController;
use App\Http\Controllers\api\LigneFactureController;
use App\Http\Controllers\api\anneescolaireController;
use App\Http\Controllers\api\employeEnfantController;
use App\Http\Controllers\api\PaimentEnfantController;
use App\Http\Controllers\api\activiteEnfantController;
use App\Http\Controllers\api\PointageEnfantController;


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
 Route::get('famille/getBycinpere/{cinpere}/', [FamilleController::class, 'existpere']);
 Route::get('famille/getBycinmere/{cinmere}/', [FamilleController::class, 'existmere']);

//Route of message
 
Route::get('message', [MessageController::class, 'index']);
Route::post('message', [MessageController::class, 'ajouter']);
Route::get('message/{id}', [MessageController::class, 'getById']);
Route::put('message/{id}/edit', [MessageController::class, 'update']);
Route::delete('message/{id}/delete', [MessageController::class, 'delete']);
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
 
  Route::get('repas', [RepasController::class, 'index']);
  Route::post('repas', [RepasController::class, 'ajouter']);
  Route::get('repas/{id}', [RepasController::class, 'getById']);
  Route::put('repas/{id}/edit', [RepasController::class, 'update']);
  Route::delete('repas/{id}/delete', [RepasController::class, 'delete']);
 //Route of repas_enfant
 
 Route::get('repas_enfant', [RepasEnfantController::class, 'index']);
 Route::post('repas_enfant', [RepasEnfantController::class, 'ajouter']);
 Route::get('repas_enfant/{id}', [RepasEnfantController::class, 'getById']);
 Route::put('repas_enfant/{id}/edit', [RepasEnfantController::class, 'update']);
 Route::delete('repas_enfant/{id}/delete', [RepasEnfantController::class, 'delete']);
 //Route of mode_paiment
 
 Route::get('mode_paiment', [ModePaimentController::class, 'index']);
 Route::post('mode_paiment', [ModePaimentController::class, 'ajouter']);
 Route::get('mode_paiment/{id}', [ModePaimentController::class, 'getById']);
 Route::put('mode_paiment/{id}/edit', [ModePaimentController::class, 'update']);
 Route::delete('mode_paiment/{id}/delete', [ModePaimentController::class, 'delete']); 
 //Route of PaimentEnfant
 
 Route::get('PaimentEnfant', [PaimentEnfantController::class, 'index']);
 Route::post('PaimentEnfant', [PaimentEnfantController::class, 'ajouter']);
 Route::get('PaimentEnfant/{id}', [PaimentEnfantController::class, 'getById']);
 Route::put('PaimentEnfant/{id}/edit', [PaimentEnfantController::class, 'update']);
 Route::delete('PaimentEnfant/{id}/delete', [PaimentEnfantController::class, 'delete']); 
 //Route of facture
Route::get('facture', [FactureController::class, 'index']);
Route::post('facture', [FactureController::class, 'ajouter']);
Route::get('facture/{id}', [FactureController::class, 'getById']);
Route::put('facture/{id}/edit', [FactureController::class, 'update']);
Route::delete('facture/{id}/delete', [FactureController::class, 'delete']);
 //Route of ligne_facture
 Route::get('ligne_facture', [LigneFactureController::class, 'index']);
 Route::post('ligne_facture', [LigneFactureController::class, 'ajouter']);
 Route::get('ligne_facture/{id}', [LigneFactureController::class, 'getById']);
 Route::put('ligne_facture/{id}/edit', [LigneFactureController::class, 'update']);
 Route::delete('ligne_facture/{id}/delete', [LigneFactureController::class, 'delete']);
//Route of tva
Route::get('tva', [TvaController::class, 'index']);
Route::post('tva', [TvaController::class, 'ajouter']);
Route::get('tva/{id}', [TvaController::class, 'getById']);
Route::put('tva/{id}/edit', [TvaController::class, 'update']);
Route::delete('tva/{id}/delete', [FactureController::class, 'delete']);
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
//Route of dortoir
 
Route::get('dortoir', [DortoirController::class, 'index']);
Route::post('dortoir', [DortoirController::class, 'ajouter']);
Route::get('dortoir/{id}', [DortoirController::class, 'getById']);
Route::put('dortoir/{id}/edit', [DortoirController::class, 'update']);
Route::delete('dortoir/{id}/delete', [DortoirController::class, 'delete']);
//Route of salle
 
Route::get('salle', [SalleController::class, 'index']);
Route::post('salle', [SalleController::class, 'ajouter']);
Route::get('salle/{id}', [SalleController::class, 'getById']);
Route::put('salle/{id}/edit', [SalleController::class, 'update']);
Route::delete('salle/{id}/delete', [SalleController::class, 'delete']);

//Route of employe
 
Route::get('employe', [employeController::class, 'index']);
Route::post('employe', [employeController::class, 'ajouter']);
Route::get('employe/{id}', [employeController::class, 'getById']);
Route::put('employe/{id}/edit', [employeController::class, 'update']);
Route::delete('employe/{id}/delete', [employeController::class, 'delete']);
//Route of DemandeConge
 
Route::get('DemandeConge', [DemandeCongeController::class, 'index']);
Route::post('DemandeConge', [DemandeCongeController::class, 'ajouter']);
Route::get('DemandeConge/{id}', [DemandeCongeController::class, 'getById']);
Route::put('DemandeConge/{id}/edit', [DemandeCongeController::class, 'update']);
Route::delete('DemandeConge/{id}/delete', [DemandeCongeController::class, 'delete']);

//Route of CongeController
 
Route::get('CongeController', [CongeControllerController::class, 'index']);
Route::post('CongeController', [CongeControllerController::class, 'ajouter']);
Route::get('CongeController/{id}', [CongeControllerController::class, 'getById']);
Route::put('CongeController/{id}/edit', [CongeControllerController::class, 'update']);
Route::delete('CongeController/{id}/delete', [CongeControllerController::class, 'delete']);
//Route of absence
 
Route::get('absenceController', [AbsenceController::class, 'index']);
Route::post('absenceController', [AbsenceController::class, 'ajouter']);
Route::get('absenceController/{id}', [AbsenceController::class, 'getById']);
Route::put('absenceController/{id}/edit', [AbsenceController::class, 'update']);
Route::delete('absenceController/{id}/delete', [AbsenceController::class, 'delete']);
//Route of salaire
 
Route::get('salaire', [SalaireController::class, 'index']);
Route::post('salaire', [SalaireController::class, 'ajouter']);
Route::get('salaire/{id}', [SalaireController::class, 'getById']);
Route::put('salaire/{id}/edit', [SalaireController::class, 'update']);
Route::delete('salaire/{id}/delete', [SalaireController::class, 'delete']);
// register ,login,logout
 Route::post('/auth/logout', [UserController::class, 'logout']);
 Route::post('/auth/register', [UserController::class, 'createUser']);
 Route::post('/auth/login', [UserController::class, 'loginUser']);

 Route::get('/auth/users', [UserController::class, 'index']);
