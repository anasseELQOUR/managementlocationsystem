<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\Utilisateurs;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/articles', function () {
//     return Article::with("type")->get();
// });

// Route::get('/types', function () {
//     return TypeArticle::with("articles")->paginate(5);
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Le groupe de routes relatives aux administrateurs uniquement
Route::group([
    "middleware" =>["auth", "auth.admin"],
    "as"=>"admin."
], function (){
    Route::group([
        "prefix"=>"habilitations",
        "as"=>"habilitations."
    ], function (){
        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
        // pour accéder à utilisateurs on doit définir le chemin suivant le as admin. et le as habilitations. et le nom de la route comme cecci admin.habilitations.users.index  admin.habilitations.users.index
    });

});

// Route::get('/habilitations/utilisateurs', [App\Http\Controllers\UserController::class, 'index'])->name('utilisateurs')->middleware("auth.admin"); // on ajoute middleware afin de définir les autorisations dans notre cas seulement l'admin peut consulter la page users
// le mot clé get permet de limite également l'accès non seulement au niveau de l'affichage  des menus ou autres choses mais aussi permet de limiter l'accès au niveau des routes moyanant bien évidement du mot clé  middlewie("can:admin")

