n <?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(["message" => "Deu certo"], 200);
});
