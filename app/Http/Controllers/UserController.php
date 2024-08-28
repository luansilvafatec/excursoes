<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cria-conta');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->cpf = preg_replace("/[^0-9]/", "", $request->cpf);

        $request->validate([
            'cpf' => ['required', new Cpf()],
            [
                'cpf.required' => 'O CPF é obrigatório',
            ]
        ]);

        if(User::where('CPF', $request->cpf)->count() > 0){
            throw ValidationException::withMessages(['cpf' => 'Este CPF já está cadastado, faça login em sua conta ou contate o suporte.']);
        }



        $validated = $request->validate(
            [
                'tipo' => 'required|integer|min:1|max:4',
                'nome' => 'required|min:5|max:50',
                'nomesocial' => 'nullable|min:3|max:50',
                'rg' => 'required|min:5|max:25',
                'cpf' => ['required', 'unique:users,CPF', new Cpf()],
                'celular' => ['required', 'regex:/^(?:(?:\+)?(55)\s?)?(?:\(?(?:[0-0]?([1-9]{1}[1-9]{1}))\)?\s?)([1-9](?:\s?\.?)\d{4}\-?\d{4})$/'],
                'curso' => 'nullable',
                'semestre' => 'nullable',
                'nascimento' => ['required'],
                'email' => ['required','unique:users'],
                'password' => ['required'],
            ],
            [
                'tipo.required' => 'O relação com a fatec é obrigatório',
                'nome.required' => 'O Nome é obrigatório',
                'nome.min' => 'O Nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O Nome precisa ter no máximo 50 caracteres',
                'rg.required' => 'O RG é obrigatório',
                'rg.min' => 'O RG precisa ter no mínimo 5 caracteres',
                'rg.max' => 'O RG precisa ter no máximo 25 caracteres',
                'cpf.required' => 'O CPF é obrigatório',
                'cpf.unique' => 'Este CPF já está cadastado, faça login em sua conta!',
                'nascimento.required' => 'O Nascimento é obrigatório',
                'celular.required' => 'O Celular é obrigatório',
                'email.required' => 'O Email é obrigatório',
                'email.unique' => 'O Email já está cadastrado! Faça login em sua conta',
                'password.required' => 'A senha é obrigatório',
            ]
        );

        // dd($request);
        $user = new User();
        $user->tipo = $validated['tipo'];
        $user->nome = $validated['nome'];
        $user->nome_social = $validated['nomesocial'];
        $user->RG = $validated['rg'];
        $user->CPF = preg_replace("/[^0-9]/", "", $validated['cpf']);
        $user->nascimento = $validated['nascimento'];
        $user->curso_id = $validated['curso'];
        $user->semestre = $validated['semestre'];
        $user->celular = preg_replace("/[^0-9]/", "", $validated['celular']);
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        $user->save();

        Auth::login($user);

        return redirect(route('minhas-excursoes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'tipo' => 'required|integer|min:1|max:4',
                'nome' => 'required|min:5|max:50',
                'nomesocial' => 'nullable|min:3|max:50',
                'rg' => 'required|min:5|max:25',
                'celular' => ['required', 'regex:/^(?:(?:\+)?(55)\s?)?(?:\(?(?:[0-0]?([1-9]{1}[1-9]{1}))\)?\s?)([1-9](?:\s?\.?)\d{4}\-?\d{4})$/'],
                'curso' => 'nullable',
                'semestre' => 'nullable',
                'nascimento' => ['required'],
                'email' => ['required',Rule::unique('users')->ignore(Auth::id())],
                'password' => ['required_if:alterasenha,1'],
            ],
            [
                'tipo.required' => 'O relação com a fatec é obrigatório',
                'nome.required' => 'O Nome é obrigatório',
                'nome.min' => 'O Nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O Nome precisa ter no máximo 50 caracteres',
                'rg.required' => 'O RG é obrigatório',
                'rg.min' => 'O RG precisa ter no mínimo 5 caracteres',
                'rg.max' => 'O RG precisa ter no máximo 25 caracteres',
                'cpf.required' => 'O CPF é obrigatório',
                'cpf.unique' => 'Este CPF já está cadastado, faça login em sua conta!',
                'nascimento.required' => 'O Nascimento é obrigatório',
                'celular.required' => 'O Celular é obrigatório',
                'email.required' => 'O Email é obrigatório',
                'email.unique' => 'O Email já está cadastrado!',
                'password.required' => 'A senha é obrigatório',
            ]
        );

        $user = User::find($id);

        $user->tipo = $validated['tipo'];
        $user->nome = $validated['nome'];
        $user->nome_social = $validated['nomesocial'];
        $user->RG = $validated['rg'];
        $user->nascimento = $validated['nascimento'];
        $user->curso_id = $validated['curso'];
        $user->semestre = $validated['semestre'];
        $user->celular = preg_replace("/[^0-9]/", "", $validated['celular']);
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function minhasExcursoes(){
        $user = Auth::user();
        return view('minhas-excursoes', compact('user'));
    }
    public function meusDados(){
        $user = Auth::user();
        return view('meus-dados', compact('user'));
    }

    public function editaUsuario($cpf = null){
        if ($cpf) {
            $user = User::where('CPF', $cpf)->first();
        }else{
            $user = new User();
        }

        return view('inserir-editar-aluno', compact('user', 'cpf'));
    }

    public function salvaUsuario(Request $request, $cpf = null)
    {

        $validated = $request->validate(
            [
                'tipo' => 'required|integer|min:1|max:5',
                'nome' => 'required|min:5|max:50',
                'nomesocial' => 'nullable|min:3|max:50',
                'rg' => 'required|min:5|max:25',
                'cpf' => ['required', 'unique:users,CPF', new Cpf()],
                'celular' => ['required', 'regex:/^(?:(?:\+)?(55)\s?)?(?:\(?(?:[0-0]?([1-9]{1}[1-9]{1}))\)?\s?)([1-9](?:\s?\.?)\d{4}\-?\d{4})$/'],
                'curso' => 'nullable',
                'semestre' => 'nullable',
                'nascimento' => ['required'],
                'email' => ['required', Rule::unique('users')->ignore(Auth::id())],
                'password' => ['required_if:alterasenha,1'],
            ],
            [
                'tipo.required' => 'O relação com a fatec é obrigatório',
                'tipo.integer' => 'O relação com a fatec invália',
                'tipo.integer' => 'O relação com a fatec fora do esperado',
                'nome.required' => 'O Nome é obrigatório',
                'nome.min' => 'O Nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O Nome precisa ter no máximo 50 caracteres',
                'nomesocial.min' => 'O Nome Social precisa ter no mínimo 3 caracteres',
                'nomesocial.max' => 'O Nome Social precisa ter no máximo 50 caracteres',
                'rg.required' => 'O RG é obrigatório',
                'rg.min' => 'O RG precisa ter no mínimo 5 caracteres',
                'rg.max' => 'O RG precisa ter no máximo 25 caracteres',
                'cpf.required' => 'O CPF é obrigatório',
                'cpf.unique' => 'Este CPF já está cadastado, faça login em sua conta!',
                'nascimento.required' => 'O Nascimento é obrigatório',
                'celular.required' => 'O Celular é obrigatório',
                'celular.regex' => 'Celular inválido',
                'email.required' => 'O Email é obrigatório',
                'email.unique' => 'O Email já está cadastrado!',
                'password.required' => 'A senha é obrigatório',
            ]
        );

        if ($cpf) {
            $user = User::where('CPF', $cpf)->first();
        }else{
            $user = new User();
            if(User::where('CPF', preg_replace("/[^0-9]/", "", $request->cpf))->count() > 0){
                throw ValidationException::withMessages(['cpf' => 'Este CPF já está cadastado!']);
            }
        }

        $user->tipo = $validated['tipo'];
        $user->nome = $validated['nome'];
        $user->nome_social = $validated['nomesocial'];
        $user->RG = $validated['rg'];
        $user->CPF = preg_replace("/[^0-9]/", "", $validated['cpf']);
        $user->nascimento = $validated['nascimento'];
        $user->curso_id = $validated['curso'];
        $user->semestre = $validated['semestre'];
        $user->celular = preg_replace("/[^0-9]/", "", $validated['celular']);
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        $user->save();
    }
}
