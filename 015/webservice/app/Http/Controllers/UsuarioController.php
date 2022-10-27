<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use App\Models\User;

use Auth;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return $validacao->errors();
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->plainTextToken;
            $user->imagem = asset($user->imagem);
            return $user;
        } else {
            return 'Verifique os dados preenchidos';
        }
    }
}
