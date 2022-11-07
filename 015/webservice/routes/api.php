<?php

use App\Models\User;
use App\Models\Conteudo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
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

Route::post('/cadastro', function (Request $request) {
    $data = $request->all();

    $avaliacao = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if ($avaliacao->fails()) {
        return $avaliacao->errors();
    }

    $imagem = '/perfils/perfil.png';

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'imagem' => $imagem,
    ]);
    $user->imagem = asset($user->imagem);
    $user->token = $user->createToken($user->email)->plainTextToken;
    return $user;
});

Route::post('/login', function (Request $request) {
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
});

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->put('/perfil', function (Request $request) {
    $user = $request->user();
    $data = $request->all();

    if (isset($data['password'])) {
        $validacao = Validator::make($data, [
            'name' => 'required|max:255|string',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);
        if ($validacao->fails()) {
            return $validacao->errors();
        }
        $user->password = bcrypt($data['password']);
        $user->name = $data['name'];
        $user->email = $data['email'];
    } else {
        $validacao = Validator::make($data, [
            'name' => 'required|max:255|string',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);
        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
    }

    if (isset($data['imagem'])) {

        Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
            $explode = explode(',', $value);
            $allow = ['png', 'jpg', 'svg', 'jpeg'];
            $format = str_replace(
                [
                    'data:image/',
                    ';',
                    'base64',
                ],
                [
                    '', '', '',
                ],
                $explode[0]
            );

            // check file format
            if (!in_array($format, $allow)) {
                return false;
            }

            // check base64 format
            if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                return false;
            }

            return true;
        });

        $validacao = Validator::make($data, [
            'imagem' => 'base64image',
        ], ['base64image' => 'Imagem inválida']);
        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $time = time();
        $diretorioPai = 'perfils';
        $diretorioImagem = $diretorioPai . DIRECTORY_SEPARATOR . 'perfil_id' . $user->id;
        $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
        $urlImagem = $diretorioImagem . DIRECTORY_SEPARATOR . $time . '.' . $ext;
        $file = str_replace('data:image/' . $ext . ';base64,', '', $data['imagem']);
        $file = base64_decode($file);

        if (!file_exists($diretorioPai)) {
            mkdir($diretorioPai, 0700);
        }

        if ($user->imagem) {
            if (file_exists($user->imagem)) {
                unlink($user->imagem);
            }
        }

        if (!file_exists($diretorioImagem)) {
            mkdir($diretorioImagem, 0700);
        }

        file_put_contents($urlImagem, $file);

        $user->imagem = $urlImagem;

    }

    $user->save();
    $user->imagem = asset($user->imagem);
    $user->token = $user->createToken($user->email)->plainTextToken;
    return $user;

});

Route::get('/testes', function () {
    $user = User::find(12);
    $user2 = User::find(22);
    // $user->conteudos()->create([
    //     'titulo' => 'Conteudo3',
    //     'texto' => "Aqui o texto",
    //     'imagem' => 'url da imagem',
    //     'link' => 'link',
    //     'data' => '2022-05-10'
    // ]);

    // return $user->conteudos;
    // $user->amigos()->attach($user2->id);
    //$user->amigos()->detach($user2->id);
    // $user->amigos()->toggle($user2->id);
    // return $user->amigos;

    $conteudo = Conteudo::find(1);
    // $user->curtidas()->toggle($conteudo->id);
    // return $conteudo->curtidas;

    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => "Aqui o texto",
        'data' => date('Y-m-d'),
    ]);

    $user2->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => "OHHHH",
        'data' => date('Y-m-d'),
    ]);

    return $conteudo->comentarios;
});
