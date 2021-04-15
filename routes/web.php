<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\UserPermissionController;
use App\Http\Controllers\backend\CreateQuizController;
use App\Http\Controllers\backend\CreateSectionController;
use App\Http\Controllers\backend\CreateQuestionController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

Route::get('/home', [HomeController::class, 'index'])->name('home');
//user permission
Route::get('/user_permission', [UserPermissionController::class, 'index'])->name('user_permission');
Route::post('/user_permission/save_data', [UserPermissionController::class,'save_data']);
Route::post('/user_permission/delete_data', [UserPermissionController::class,'delete_data']);

//Quiz Portion..
Route::get('/create_quiz', [CreateQuizController::class, 'index'])->name('create_quiz');
Route::post('/quiz/SaveData', [CreateQuizController::class, 'store']);
Route::get('/quiz/GetData/{id}', [CreateQuizController::class, 'GetData']);
Route::post('/quiz/UpdateData', [CreateQuizController::class, 'update']);
Route::get('quiz/publish/{Status}/{QuizID}', [CreateQuizController::class, 'publication']);

//Quiz Section Portion.. 
Route::get('/quiz_section', [CreateSectionController::class, 'index'])->name('create_section');
Route::post('/Section/SaveData', [CreateSectionController::class, 'store']);
Route::post('/Section/UpdateData', [CreateSectionController::class, 'update']);
Route::get('/Section/GetData/{id}', [CreateSectionController::class, 'GetData']);
Route::get('Section/publish/{Status}/{QsecID}', [CreateSectionController::class, 'publication']);

//Section Question Portion.. 
Route::get('/create_question', [CreateQuestionController::class, 'index'])->name('create_question');
Route::post('/Question/SaveData', [CreateQuestionController::class, 'store']);
Route::get('/Question/GetData/{id}', [CreateQuestionController::class, 'GetData']);
Route::get('Question/publish/{Status}/{QuestionID}', [CreateQuestionController::class, 'publication']);
Route::post('/Question/UpdateData', [CreateQuestionController::class, 'update']);

//Question Option Portion... 
Route::post('/Option/SaveData', [CreateQuestionController::class, 'store_option']);
Route::post('/Option/UpdateData', [CreateQuestionController::class, 'update_option']);

//Assign section wise pass marks.. 
Route::get('/pass_marks', [CreateSectionController::class, 'passmarks'])->name('passmarks');
Route::get('/Get/TotalMarks/{QsecID}', [CreateSectionController::class, 'sectionwise_totalMarks']);
Route::post('/pass_marks/SaveData', [CreateSectionController::class, 'store_passmarks']);
Route::get('/passmarks/GetData/{id}', [CreateSectionController::class, 'GetPassData']);
Route::post('/pass_marks/UpdateData', [CreateSectionController::class, 'update_passmarks']);

});