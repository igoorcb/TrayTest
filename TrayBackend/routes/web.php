<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'API TrayTest rodando com sucesso! 🎉']);
});
