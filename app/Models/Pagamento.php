<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;


    public function getValorFormatadoAttribute(){
        return number_format($this->valor, 2, ',', '.');
    }
    public function getMeioFormatadoAttribute(){
        switch ($this->pagamento_meio) {
            case 1:
                return "Dinheiro";
            break;
            case 2:
                return "PIX Conta";
            break;
            case 3:
                return "PIX Online";
            break;

            default:
                return "Indefinido";
            break;
        }
    }
    public function getDataHoraFormatadoAttribute() {
        return Carbon::parse($this->created_at)->format('d/m/Y - H:i');
    }
}
