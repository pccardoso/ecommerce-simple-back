<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


Route::post('/login', function (Request $request) {


    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required', // Nome do dispositivo (ex: "iPhone do Joao")
    ]);

    $user = User::where('email', $request->email)->first();

    // Verifica se o usuário existe e se a senha está correta
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas.'],
        ]);
    }

    return response()->json([
        "message" => "Usuário autenticado com sucesso!",
        "data" => $user,
        "token" => $user->createToken($request->device_name)->plainTextToken
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
});