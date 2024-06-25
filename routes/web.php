<?php

use App\Http\Controllers\DeployController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Evento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/deploy/{password}', [DeployController::class, 'deploy']);

Route::get('/', function () {
    $eventos = Evento::whereDate("data_inscricao_inicio", "<", Carbon::today())->whereDate("data_inscricao_fim" , ">", Carbon::today())->get();
    return view('home', compact('eventos'));
});

Route::get('/teste', function () {
    $evento = Evento::first();
    dd($evento->interessados);
    dd(User::first()->TotalPagoEvento($evento));
});

Route::view('/login', 'login')->name('login');

Route::post('/logar', function (Request $request) {
    // dd($request->all());
    $credentials = $request->validate([
        'cpf' => ['required'],
        'password' => ['required'],
    ]);

    $credentials['cpf'] = preg_replace("/[^0-9]/", "", $credentials['cpf'] );

    if (Auth::attempt(['CPF' => $credentials['cpf'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('logar');

Route::resource('user', UserController::class);
