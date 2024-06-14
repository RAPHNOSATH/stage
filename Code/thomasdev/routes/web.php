<?php

use App\Http\Controllers\acceuilController;
use App\Http\Controllers\Authentification\AnnonceController;
use App\Http\Controllers\Authentification\BailleurDeFondController;
use App\Http\Controllers\Authentification\ChercheurController;
use App\Http\Controllers\Authentification\CommuniqueController;
use App\Http\Controllers\Authentification\DomaineController;
use App\Http\Controllers\Authentification\EquipeController;
use App\Http\Controllers\Authentification\LoginUserController;
use App\Http\Controllers\Authentification\MinistereController;
use App\Http\Controllers\Authentification\PartenaireController;
use App\Http\Controllers\Authentification\RegisteredUserController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\Gestion\GestionController;
use App\Http\Controllers\Notation\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Suivi\SuiviController;
use App\Models\Equipe;
use Illuminate\Support\Facades\Auth;
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


Route::get('/home',[acceuilController::class,'home'])->name('home');
Route::get('/contact',[acceuilController::class,'contact'])->name('contact');
Route::post('/contact',[acceuilController::class,'contactStore'])->name('contact');
Route::prefix('auth')->group(function (){
    Route::get('/register',[RegisteredUserController::class,'create'] )->name('register1');
    Route::post('/register', [RegisteredUserController::class,'store'])->name('register1');
    Route::get('/login', [LoginUserController::class,'create'])->name('login1');
    Route::post('/login', [LoginUserController::class,'store'])->name('login1');
    Route::get('/loginMembre', [LoginUserController::class,'createMembre'])->name('login2');
    Route::post('/loginMembre', [LoginUserController::class,'storeMembre'])->name('login2');
    Route::get('/logout', [LoginUserController::class,'destroy'])->name('logout1');
});
Route::middleware('auth')->prefix('admin')->group(function (){
    Route::get('/ministere',[MinistereController::class,'create'] )->name('ministere');
    Route::post('/ministere', [MinistereController::class,'store'])->name('ministere');
    Route::get('/bailleurdefond',[BailleurDeFondController::class,'create'] )->name('bailleurdefond');
    Route::post('/bailleurdefond', [BailleurDeFondController::class,'store'])->name('bailleurdefond');
    Route::get('/annonce',[AnnonceController::class,'create'] )->name('annonce');
    Route::post('/annonce', [AnnonceController::class,'store'])->name('annonce');
    Route::get('/allannonce',[AnnonceController::class,'annonce'] )->name('allAnnonce');
    Route::get('/partenaire',[PartenaireController::class,'create'])->name('partenaire');
    Route::post('/partenaire',[PartenaireController::class,'store'])->name('partenaire');
    Route::get('/chercheur',[ChercheurController::class,'create'])->name('chercheur');
    Route::post('/chercheur',[ChercheurController::class,'store'])->name('chercheur');
    Route::get('/equipeExperte',[EquipeController::class,'create1'])->name('equipeExperte');
    Route::post('/equipeExperte',[EquipeController::class,'store1'])->name('equipeExperte');
    Route::get('/typeEquipe',[EquipeController::class,'create3'])->name('typeEquipe');
    Route::post('/typeEquipe',[EquipeController::class,'store3'])->name('typeEquipe');
    Route::get('/domaine',[DomaineController::class,'create1'])->name('domaine');
    Route::post('/domaine',[DomaineController::class,'store1'])->name('domaine');
    Route::get('/sousdomaine',[DomaineController::class,'create2'])->name('sousdomaine');
    Route::post('/sousdomaine',[DomaineController::class,'store2'])->name('sousdomaine');
    Route::get('/communique',[AnnonceController::class,'create1'] )->name('communique');
    Route::post('/communique', [AnnonceController::class,'store1'])->name('communique');
    Route::get('/equipe',[EquipeController::class,'equipeExperte1'])->name('equipe');
    Route::get('/alldomaine',[DomaineController::class,'domaine'])->name('alldomaine');
    Route::get('/alltype',[EquipeController::class,'type'])->name('alltype');
    Route::get('/users',[ProfileController::class,'utilisateurs'])->name('users');
    Route::post('/users/{id}',[ProfileController::class,'updated'])->name('updateuser');
    Route::delete('/users/{id}',[ProfileController::class,'destroye'])->name('destroye');
    Route::put('/users/{id}',[ProfileController::class,'updated'])->name('updateuser');
});

Route::middleware('auth')->prefix('gestion')->group(function (){
    Route::get('/ajout', [GestionController::class,'create'])->name('ajout');
    Route::post('/ajout', [GestionController::class,'store'])->name('ajout');
    Route::get('/ps', [GestionController::class,'projetSoumis'])->name('projetSoumis');
    Route::get('/pa', [GestionController::class,'projetAccepte'])->name('ProjetAccepte');
    Route::get('/per', [GestionController::class,'projetEnRecherche'])->name('projetEnRecherche');
    Route::get('/resultats',[GestionController::class,'resultat'])->name('resultats');
    Route::get('/dps/{id}', [GestionController::class,'detailProjetSoumis'])->name('detailProjetSoumis');
});
Route::middleware('auth:membre')->prefix('gestion')->group(function (){
    Route::get('/ps1', [GestionController::class,'projetSoumis'])->name('projetSoumis1');
    Route::get('/pa1', [GestionController::class,'projetAccepte'])->name('ProjetAccepte1');
    Route::get('/validate1', [GestionController::class,'validateProject'])->name('validateProject1');
    Route::get('/per1', [GestionController::class,'projetEnRecherche'])->name('projetEnRecherche1');
    Route::get('/resultats1',[GestionController::class,'resultat'])->name('resultats1');
    Route::get('/dps1/{id}', [GestionController::class,'detailProjetSoumis'])->name('detailProjetSoumis1');
    Route::get('/updateProjet1/{id}',[GestionController::class,'validated'])->name('updateProjet1');
});

Route::middleware('auth')->prefix('suivi')->group(function (){
    Route::get('/allequipeDeRecherche',[EquipeController::class,'equipeDeRecherche'])->name('allequipeDeRecherche');
    Route::get('/allequipeExperte',[EquipeController::class,'equipeExperte2'])->name('allequipeExperte');
    Route::get('/equipeDeRecherche',[EquipeController::class,'create2'])->name('equipeDeRecherche');
    Route::post('/equipeDeRecherche',[EquipeController::class,'store2'])->name('equipeDeRecherche');
    Route::get('/verification/resultats',[SuiviController::class,'resultat'])->name('verification');
    Route::get('/equipe/membre/{id}',[EquipeController::class,'membre'])->name('allMembre');
    Route::delete('/equipe/membre/{id}',[EquipeController::class,'deleted'])->name('deleted');
    Route::post('/equipe/{id}',[EquipeController::class,'store4'])->name('membre');
    Route::get('/equipe/{id}',[EquipeController::class,'edit'])->name('edit');
    Route::put('/equipe/{id}', [EquipeController::class,'update'])->name('update');
    Route::delete('/equipe/{id}', [EquipeController::class,'delete'])->name('delete');
    Route::get('/activation/{id}',[EquipeController::class,'activer'])->name('activation');
    Route::get('/desactivation/{id}',[EquipeController::class,'desactiver'])->name('desactivation');
    Route::get('/membre/desactivation/{id}',[SuiviController::class,'desactiver']);
    Route::get('/membre/activation/{id}',[SuiviController::class,'activer']);
    Route::get('/enpause/{id}',[EquipeController::class,'pause'])->name('enpause');
    Route::post('/role/{id}',[EquipeController::class,'role'])->name('role');
    Route::get('/solution/details/{id}',[SuiviController::class,'detailSolution']);
});
Route::middleware('auth:membre')->prefix('suivi')->group(function (){
    Route::get('/allequipeDeRecherche1',[EquipeController::class,'equipeDeRecherche'])->name('allequipeDeRecherche1');
    Route::get('/allequipeExperte1',[EquipeController::class,'equipeExperte2'])->name('allequipeExperte1');
    Route::get('/equipeDeRecherche1',[EquipeController::class,'create2'])->name('equipeDeRecherche1');
    Route::post('/equipeDeRecherche1',[EquipeController::class,'store2'])->name('equipeDeRecherche1');
    Route::get('/resultatForm',[SuiviController::class,'create'])->name('resultatForm');
    Route::post('/resultatForm',[SuiviController::class,'store'])->name('resultatForm');
    Route::get('/verification1/resultats',[SuiviController::class,'resultat'])->name('verification1');
    Route::get('/validation/resultats',[SuiviController::class,'validation'])->name('validation');
    Route::post('/validation/resultats/{id}',[SuiviController::class,'validationStore']);
    Route::get('/solution/publier/{id}',[SuiviController::class,'publier'])->name('publier');
    Route::get('/equipe/membre1/{id}',[EquipeController::class,'membre'])->name('allMembre1');
    Route::delete('/equipe/membre1/{id}',[EquipeController::class,'deleted'])->name('deleted1');
    Route::post('/equipe1/{id}',[EquipeController::class,'store4'])->name('membre1');
    Route::get('/equipe1/{id}',[EquipeController::class,'edit'])->name('edit1');
    Route::put('/equipe1/{id}', [EquipeController::class,'update'])->name('update1');
    Route::delete('/equipe1/{id}', [EquipeController::class,'delete'])->name('delete1');
    Route::get('/activation1/{id}',[EquipeController::class,'activer'])->name('activation1');
    Route::get('/desactivation1/{id}',[EquipeController::class,'desactiver'])->name('desactivation1');
    Route::get('/membre/desactivation1/{id}',[SuiviController::class,'desactiver']);
    Route::get('/membre/activation1/{id}',[SuiviController::class,'activer']);
    Route::get('/enpause1/{id}',[EquipeController::class,'pause'])->name('enpause1');
    Route::post('/role1/{id}',[EquipeController::class,'role'])->name('role1');
    Route::post('/update/solution/{id}',[SuiviController::class,'updateSolution'])->name('updateSolution');
    Route::put('/update/solution/{id}',[SuiviController::class,'updateSolution'])->name('updateSolution');
    Route::get('/solution/details1/{id}',[SuiviController::class,'detailSolution']);
});

Route::middleware('auth')->prefix('commentaire')->group(function (){
    Route::get('/projet',[CommentaireController::class,'projet'])->name('projet');
    Route::get('/projet/{id}',[CommentaireController::class,'detail'])->name('comment');
    Route::post('/projet/{id}',[CommentaireController::class,'comment'])->name('comment');
    Route::post('/utilisateur/{id}',[CommentaireController::class,'repondre']);
});
Route::middleware('auth:membre')->prefix('commentaire')->group(function (){
    Route::get('/projet1',[CommentaireController::class,'projet'])->name('projet1');
    Route::get('/projet1/{id}',[CommentaireController::class,'detail'])->name('comment1');
    Route::post('/projet1/{id}',[CommentaireController::class,'comment'])->name('comment1');
    Route::post('/utilisateur1/{id}',[CommentaireController::class,'repondre']);
});

Route::middleware('auth')->prefix('note')->group(function (){
    Route::get('/acceuil',[NoteController::class,'acceuil'])->name('acceuil');
    Route::get('/solution',[NoteController::class,'resultat'])->name('solution');
    Route::post('/utilisateur/{id}',[NoteController::class,'store']);
    Route::get('/utilisateur/{id}',[NoteController::class,'create'])->name('utilisateur');
    Route::get('/details/{id}',[NoteController::class,'detailNote'])->name('detailNote');
    Route::get('/solution/details/{id}',[NoteController::class,'detailSolution'])->name('detailSolution');
});
Route::middleware('auth:membre')->prefix('note')->group(function (){
    Route::get('/acceuil1',[NoteController::class,'acceuil'])->name('acceuil1');
    Route::get('/solution1',[NoteController::class,'resultat'])->name('solution1');
    Route::post('/utilisateur1/{id}',[NoteController::class,'store']);
    Route::get('/details1/{id}',[NoteController::class,'detailNote'])->name('detailNote1');
    Route::get('/utilisateur1/{id}',[NoteController::class,'create'])->name('utilisateur1');
    Route::get('/solution/details1/{id}',[NoteController::class,'detailSolution'])->name('detailSolution1');
});

require __DIR__.'/auth.php';
