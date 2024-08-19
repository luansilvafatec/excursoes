<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Passageiro extends Model
{
    use HasFactory;

    public function user() : HasOne {
        return $this->hasOne(User::class);
    }

    public function pagamentos() : HasMany {
        return $this->hasMany(Pagamento::class);
    }

    public function getTotalPagoAttribute()
    {
        return $this->pagamentos()->sum('valor');
    }
}
