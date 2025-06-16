<?php

// routes/api.php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\ReceiveDataController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class);

// todas as rotas abaixo precisam de token Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // endpoint para o app buscar o identifier
    Route::get('/me/identifier', function (\Illuminate\Http\Request $request) {
        return response()->json([
            'identifier' => $request->user()->identifier,
        ]);
    });

    // recebimento de dados
    Route::post('/receive', [ReceiveDataController::class, 'store']);
    Route::get('/received-data', [ReceiveDataController::class, 'index']);
});
