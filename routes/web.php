<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoExamWithRdmQuestionsController;
use App\Http\Controllers\StoreExamController;
use App\Http\Controllers\GetDoItExamsController;
use App\Http\Controllers\GetSolutionsOfExamController;
use App\Http\Controllers\TeacherController;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\User;

use Laravel\Socialite\Facades\Socialite;
 
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    
    $userExist = User::where('oauth_id', $user->id)->first();
    
    if ($userExist) {
        $user = $userExist;
    } else {
        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'oauth_id' => $user->id,
        ]);
    }

    Auth::login($user);

    return redirect('/do-exam-rdm');
});

use App\Http\Middleware\CheckTeacherRole;

// Aplica el middleware a un grupo de rutas
Route::middleware([CheckTeacherRole::class])->group(function () {
    Route::get('/teacher-dashboard', [TeacherController::class, 'index'])->name('teacher-dashboard');
    Route::get('/teacher-user-exams/{id}', [TeacherController::class, 'getExamsFromUser'])->name('teacher-user-exams');
});

/* 
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/do-exam-rdm', [DoExamWithRdmQuestionsController::class, 'index'])->name('exam-rdm-questions');
    Route::post('/store-exam', [StoreExamController::class, 'store'])->name('store-exam');
    Route::get('/my-exams', [GetDoItExamsController::class, 'getExamsForTheAuthUser'])->name('my-exams');
    Route::get('/exam-solutions/{exam_id}', [GetSolutionsOfExamController::class, 'getExamSolutions'])->name('exam-solutions');
});

/*
Route::get('/teacher-dashboard', function () {
    return Inertia::render('TeacherDashboard');
})->middleware(['auth', 'verified', CheckTeacherRole::class])->name('teacher-dashboard');
*/
require __DIR__.'/auth.php';
