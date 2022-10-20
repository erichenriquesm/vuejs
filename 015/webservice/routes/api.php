<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/cadastro', function(Request $request){
    $data = $request->all();
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    $user->token = $user->createToken($user->email)->plainTextToken;
    return $user;
});

Route::post('/login',function(Request $request){
    $data = $request->all();

    if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->plainTextToken;
        return $user;
    }else{
        return 'Verifique os dados preenchidos';
    }
});

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->user();
});
