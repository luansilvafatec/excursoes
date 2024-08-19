<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Cpf;
use Illuminate\Http\Request;

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

        $validated = $request->validate([
            'tipo' => 'required|integer|min:1|max:3',
            'nome' => 'required|min:5|max:50',
            'rg' => 'required|min:5|max:25',
            'cpf' => ['required','unique:users,CPF', new Cpf()],
            'email' => ['required','unique:users,email'],
        ]);

        // dd($request);
        $user = new User();
        $user->tipo = $request->tipo;
        $user->nome = $request->nome;
        $user->nome_social = $request->nomeSocial;
        $user->RG = $request->rg;
        $user->CPF = preg_replace("/[^0-9]/", "",$request->cpf);
        $user->nascimento = $request->nascimento;
        $user->celular = $request->celular;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();


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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
