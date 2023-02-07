<?php

use MailchimpMarketing\ApiClient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;



Route::get('/', [PostController::class, 'index']);

Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

Route::post('/newsletter', NewsletterController::class)->name('newsletter');


Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'signIn']);
Route::post('/logout', [AuthController::class, 'logout']);
