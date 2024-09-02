<?php

use App\Http\Controllers\DeployController;
use App\Http\Controllers\UserController;
use App\Livewire\GestaoExcursao;
use Illuminate\Support\Facades\Route;
use App\Models\Evento;
use App\Models\User;
use App\Rules\Cpf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

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


Route::get('/login', function () {

    if (Auth::check()) {
        return redirect()->route('minhas-excursoes');
    }

    return view('cria-conta');
})->name('login');

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
        'email' => 'Usuário e senha não encontrados.',
    ])->onlyInput('cpf');
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


    Route::get('/edita-usuario/{cpf?}', [UserController::class, 'editaUsuario'])->name('edita-usuario')->middleware([\App\Http\Middleware\Adminer::class]);
    Route::post('/salva-usuario/{cpf?}', [UserController::class, 'salvaUsuario'])->name('salva-usuario')->middleware([\App\Http\Middleware\Adminer::class]);
    Route::get('/gestao-excursao/{evento}', GestaoExcursao::class)->middleware([\App\Http\Middleware\Adminer::class]);
});


Route::get('mercado-pago', function () {

     // Step 2: Set production or sandbox access token
     MercadoPagoConfig::setAccessToken("TEST-2499437448537011-082918-1296c7d4647bd37a13e93a47acb4bd1c-153434638");
     // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
     // In case you want to test in your local machine first, set runtime enviroment to LOCAL
     MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

     // Step 3: Initialize the API client
     $client = new PaymentClient();

     try {

         // Step 4: Create the request array
         $request = [
            "transaction_amount" => (float) 350,
            "payment_method_id" => "pix",
            "payer" => [
                "email" => "teste@teste.com",
                "first_name" => "luan teste",
                "identification" => [
                    "type" => "CPF",
                    "number" => "42338762800",
                ],
            ],
            "description" => "Teste pagamento parcial",
            "external_reference" => "1",
        ];

         // Step 5: Create the request options, setting X-Idempotency-Key
         $request_options = new RequestOptions();
         $request_options->setCustomHeaders(["X-Idempotency-Key: 0d5020ed-1af6-469c-ae06-c3bec19954bb"]);

         // Step 6: Make the request
         $payment = $client->create($request, $request_options);
         dd($payment,$payment->point_of_interaction->transaction_data);

     // Step 7: Handle exceptions
     } catch (MPApiException $e) {
         echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
         echo "Content: ";
         var_dump($e->getApiResponse()->getContent());
         echo "\n";
     } catch (\Exception $e) {
         echo $e->getMessage();
     }

});
