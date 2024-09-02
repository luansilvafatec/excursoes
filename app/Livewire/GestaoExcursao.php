<?php

namespace App\Livewire;

use App\Models\Evento;
use App\Models\Pagamento;
use App\Models\Passageiro;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GestaoExcursao extends Component
{

    public Evento $evento;
    public Passageiro $passageiro_selecionado;

    public $valor;
    public $tipo_pagamento=1;
    public $data;

    public function render()
    {
        return view('livewire.gestao-excursao')->layout('components.layout.layout-base');
    }

    public function selecionaPassageiro($passageiro){
        $this->passageiro_selecionado = Passageiro::find($passageiro);
    }

    public function addPagamento(){
        $pagamento = new Pagamento();

        $pagamento->passageiro_id = $this->passageiro_selecionado->id;
        $pagamento->valor = $this->valor;
        $pagamento->pagamento_meio = $this->tipo_pagamento;
        $pagamento->recebedor_id = Auth::id();
        $pagamento->created_at = $this->data;
        $pagamento->updated_at = $this->data;

        $pagamento->save();

         $this->valor = "";
        $this->tipo_pagamento=1;
        $this->data = "";

    }
}
