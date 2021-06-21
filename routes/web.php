<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NormalUserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubCategoryController;

// Routes
Route::get('/', function () {
    return redirect('login');
});

Route::match(['get', 'post'], '/dashboard', function () {
    return view('dashboard');
})->name('admin.dashboard');
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');
Auth::routes();


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('exam', ExamController::class);
    Route::resource('question', QuestionController::class);
});

Route::prefix('user')->group(function () {
    Route::get('questions', [NormalUserController::class, 'questions'])->name('questions');
    Route::get('quesiton/{question}', [NormalUserController::class, 'question'])->name('question');
    Route::put('quesiton/answer/{question}', [NormalUserController::class, 'giveAnswer'])->name('answer');
    Route::get('my/answer-list', [NormalUserController::class, 'my_answers'])->name('my_answers');
});

// ajax
Route::get('get-sub-category/{category}', [SubCategoryController::class, 'getSubCategoryByCategory'])->name('get_sub_by_cat');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
