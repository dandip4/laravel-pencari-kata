<?php

use App\Http\Controllers\KataController;
use App\Models\Kata;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api/kata/{id}/kelas', function ($id) {
    $kata = Kata::with('kelasKata')->findOrFail($id);
    return response()->json(['kelas_kata' => $kata->kelasKata->nama]);
});
Route::get('/kata/{id}/kelas', [KataController::class, 'getKelasKata']);
