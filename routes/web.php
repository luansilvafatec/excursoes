<?php

use App\Http\Controllers\DeployController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Evento;
use App\Models\User;
use App\Rules\Cpf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

Route::post('/deploy', [DeployController::class, 'deploy'])->name('deploy');

Route::get('comandos/{password}', function ($password) {
    $validPassword = env('GIT_PASSWORD'); // Altere para a senha desejada

    if ($password !== $validPassword) {
        return response()->json(['error' => 'Senha inválida!'], 403);
    }

    return view('comandos');
});

Route::get('/', function () {
    $eventos = Evento::whereDate("data_inscricao_inicio", "<", Carbon::today())->whereDate("data_inscricao_fim", ">", Carbon::today())->orderBy("data_inicio")->get();
    return view('home', compact('eventos'));
})->name('home');

Route::get('/teste', function () {
    $evento = Evento::first();
    dd($evento->contagem_confirmados);
});
Route::get('/cpf/{value}', function ($value) {
    $cpf = preg_replace('/[^0-9]/', '', $value);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) {
            return false;
        }
    }

    return true;
});

Route::view('/login', 'cria-conta')->name('login');

Route::post('/logar', function (Request $request) {
    // dd($request->all());
    $credentials = $request->validate([
        'cpf_login' => ['required'],
        'password_login' => ['required'],
    ]);

    $credentials['cpf_login'] = preg_replace("/[^0-9]/", "", $credentials['cpf_login']);

    if (Auth::attempt(['CPF' => $credentials['cpf_login'], 'password' => $credentials['password_login']])) {

        $request->session()->regenerate();

        return redirect()->intended(route('minhas-excursoes'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('logar');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->regenerate();
    return redirect()->route('home');
})->name('logout');

Route::resource('user', UserController::class);

Route::post('/validacpf', function (Request $request) {
    try {
        $request->validate([
            'cpf' => ['required', new Cpf()],
        ]);
        return response()->json(['valid' => true]);
    } catch (ValidationException $e) {
        return response()->json(['valid' => false], 422);
    }
});

Route::get('/excursao/{evento}', function (Evento $evento) {
    return view('info-evento', compact('evento'));
})->name('evento');

Route::middleware(['auth'])->group(function () {
    Route::get('/minhas-excursoes', [UserController::class, 'minhasExcursoes'])->name('minhas-excursoes');
    Route::get('/meus-dados', [UserController::class, 'meusDados'])->name('meus-dados');
});
