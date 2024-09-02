<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Passageiro extends Model
{
    use HasFactory;

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function evento() : BelongsTo {
        return $this->belongsTo(Evento::class);
    }

    public function pagamentos() : HasMany {
        return $this->hasMany(Pagamento::class)->orderBy("id", "desc");
    }

    public function getStatusAttribute() {
        return $this->user->statusEvento($this->evento);
    }
    public function getStatusFormatadoAttribute() {
        return $this->user->statusEventoFormatado($this->evento)[0];
    }
    public function getAteReservaFormatadoAttribute() {
        return $this->user->ateReservaFormatado($this->evento);
    }

    public function getTotalPagoAttribute()
    {
        return $this->pagamentos()->sum('valor');
    }
    public function getTotalPagoDescontoAttribute()
    {
        return $this->pagamentos()->sum('valor') + $this->desconto;
    }
    public function getTotalFaltaDescontoAttribute()
    {
        return $this->evento->valor - $this->pagamentos()->sum('valor') + $this->desconto;
    }
    public function getTotalFaltaDescontoFormatadoAttribute()
    {
        return number_format($this->total_falta_desconto, 2, ',', '.');
    }
    public function getTotalPagoDescontoFormatadoAttribute()
    {
        return number_format($this->total_pago_desconto, 2, ',', '.');
    }


    public function getTotalPercentAttribute()
    {
        return $this->user->totalPercentEvento($this->evento);
    }
}
