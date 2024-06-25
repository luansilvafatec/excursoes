<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evento extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'passageiros', 'evento_id', 'user_id');
    }

    public function getContagemPassageirosAttribute() : int
    {
        return $this->users()->count();
    }

    public function getVagasDisponiveisAttribute() : int {
        return $this->vagas - $this->contagem_passageiros;
    }
    public function getInteressadosAttribute() {
        // return $this->users()->where(function ($query){
        //     $query->where
        // })->dd();
    }


}
