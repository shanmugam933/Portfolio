<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ResumeController;


Route::get('/', function () {
    return view('index');
});
Route::get('/', [ViewController::class, 'index'])->name('skills');


Route::post('sendEmail', [PHPMailerController::class, 'sendEmail'])->name('sendEmail');
Route::get('/', [ViewController::class, 'index'])->name('skills');


Route::get('/download-resume', [ResumeController::class, 'downloadResume'])->name('download.resume');
Route::get('/show-resume', [ResumeController::class, 'showResume'])->name('show.resume');
