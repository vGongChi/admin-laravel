<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CompanyProfileController;
use App\Http\Controllers\Api\BusinessScopeController;
use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SiteConfigController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Navigation API
Route::get('/navigations', [NavigationController::class, 'index']);
Route::get('/navigations/{id}', [NavigationController::class, 'show']);

// Banner API
Route::get('/banners', [BannerController::class, 'index']);

// Company Profile API
Route::get('/company-profiles', [CompanyProfileController::class, 'index']);

// Business Scope API
Route::get('/business-scopes', [BusinessScopeController::class, 'index']);

// Contact Info API
Route::get('/contact-infos', [ContactInfoController::class, 'index']);

// Message API
Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);

// Site Config API
Route::get('/site-configs', [SiteConfigController::class, 'index']);
Route::get('/site-configs/{key}', [SiteConfigController::class, 'show']);

