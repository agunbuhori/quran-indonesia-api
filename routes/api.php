<?php

use App\Http\Controllers\AyahController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\KhatTypeController;
use App\Http\Controllers\SurahController;
use App\Http\Controllers\TafseerController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TranslationVersionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/khat_type', [KhatTypeController::class, 'index']);
Route::get('/translation_version', [TranslationVersionController::class, 'index']);
Route::get('/surah', [SurahController::class, 'index']);
Route::get('/surah/{surah}', [SurahController::class, 'show']);
Route::get('/juz', [SurahController::class, 'juz']);
Route::get('/juz/{juz}', [SurahController::class, 'show_juz']);
Route::get('/topic', [TopicController::class, 'index']);
Route::get('/topic/{topic}', [TopicController::class, 'show']);
Route::get('/search', [SurahController::class, 'search']);
Route::get('/page/{page}', [AyahController::class, 'page']);
Route::get('/ayah/{surah}/{ayah}', [AyahController::class, 'show']);
Route::get('/tafseer/{surah}/{ayah}', [TafseerController::class, 'show']);

Route::get('/book', [BookController::class, 'index']);
