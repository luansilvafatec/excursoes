<?php

namespace App\Livewire;

use App\Models\Passageiro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardPagamento extends Component
{
    public User $user;
    public $etapa = 1;
    public $evento;
    public $limiteReserva;


    public function Mount(){
        $this->user = Auth::user();

        switch ($this->user->statusEvento($this->evento)) {

            case 4:
                $this->etapa = 2;
                $this->limiteReserva = $this->user->ateReservaFormatado($this->evento);
            break;
            case 2:
                $this->etapa = 4;
            break;
            case 3:
                $this->etapa = 7;
            break;
            case 1:
                $this->etapa = 5;
            break;
            case 0:
                if($this->evento->possui_vagas){
                    $this->etapa = 1;
                }else{
                    $this->etapa = 6;
                }
            break;

            default:
                # code...
                break;
        }
    }

    public function render()
    {
        return view('livewire.card-pagamento');
    }

    public function preReserva(){
        $Passageiro = new Passageiro();
        $Passageiro->user_id = $this->user->id;
        $Passageiro->evento_id = $this->evento->id;

        $Passageiro->save();


        $this->limiteReserva = $this->user->ateReservaFormatado($this->evento);

        $this->etapa = 2;
    }
    public function aviseMe(){
        $Passageiro = new Passageiro();
        $Passageiro->user_id = $this->user->id;
        $Passageiro->evento_id = $this->evento->id;
        $Passageiro->espera = 1;

        $Passageiro->save();

        $this->etapa = 7;
    }


    public function pagarPix(){
        $this->etapa = 3;
    }
}
