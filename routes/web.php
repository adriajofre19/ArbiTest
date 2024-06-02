<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoExamWithRdmQuestionsController;
use App\Http\Controllers\StoreExamController;
use App\Http\Controllers\GetDoItExamsController;

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

    return redirect('/dashboard');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
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
});

require __DIR__.'/auth.php';
