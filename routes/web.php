<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    TestController,
    FirebaseController,
    HomeController,
    RecipeController,
    TrainingController,
    LanguageController,
    UserController
};
use Illuminate\Support\Facades\Cookie;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\CheckIfAuth;
use App\Http\Middleware\redirectHomeIfAuth;
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

Route::group(['middleware' => SetLocale::class], function () {
    Route::get('/', function () {

        return view('get-started');
    });

    Route::get('test', function () {
        App::setLocale('ar');
    });



    Route::group(['middleware' => CheckIfAuth::class], function () {

        Route::prefix('home')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
        });

        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
        Route::get('/search', [HomeController::class, 'search'])->name('search');

        Route::prefix(config('constants.USERS.SINGULAR'))->group(function () {
            Route::get('/', [FirebaseController::class, 'getAllUsers'])->name('get-firebase-users');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::post('/update', [UserController::class, 'update'])->name('update');
            Route::post('/upload-profile-image', [UserController::class, 'uploadProfileImage'])->name('profile.upload-profile-image');
        });

        Route::prefix(config('constants.RECIPES.COLLECTION'))->group(
            function () {
                Route::get('/{page?}', [RecipeController::class, 'publicIndex'])->name('recipe.publicIndex');
                Route::get('/videos/{id}', [RecipeController::class, 'video'])->middleware([
                    'checkSubscription'
                ])->name('recipes.video');
                Route::get('/get/categorized', [RecipeController::class, 'categorized'])->name('recipe.categorized');
            }
        );

        Route::prefix(config('constants.TRAININGS.COLLECTION'))->group(
            function () {
                Route::get('/{page?}', [TrainingController::class, 'publicIndex'])->name('training.publicIndex');
                Route::get('/videos/{id}', [TrainingController::class, 'video'])->name('trainings.video');
                Route::get('/get/categorized', [TrainingController::class, 'categorized'])->name('training.categorized');
            }
        );
    });
});

// Below admin section
Route::prefix('admin')->name('admin.')->group(
    function () {

        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource(config('constants.RECIPES.COLLECTION'), RecipeController::class);
        Route::resource(config('constants.TRAININGS.COLLECTION'), TrainingController::class);
    }
);


Route::post('change-language', [LanguageController::class, 'change'])->name('change-language');


/*
Route::get('/', function(){
  return 'website is under maintenance';
});*/
