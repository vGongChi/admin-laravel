<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UploadController;

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

Route::get('/', function () {
    return redirect('/frontend/home.html');
});

Route::get('/frontend/home.html', function () {
    return response()->file(base_path('frontend/home.html'));
});

Route::get('/frontend/{path}', function ($path) {
    $file = base_path('frontend/' . $path);

    if (!file_exists($file) || is_dir($file)) {
        abort(404);
    }

    return response()->file($file);
})->where('path', '.*');

#上面要引入 use App\Http\Controllers\UploadController;
Route::post('/upload',[UploadController::class,'upload']);
