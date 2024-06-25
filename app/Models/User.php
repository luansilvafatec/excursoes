<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Evento;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function eventos(): BelongsToMany
    {
        return $this->belongsToMany(Evento::class, 'passageiros', 'user_id', 'evento_id');
    }

    public function pagamentos(): HasManyThrough
    {
        return $this->hasManyThrough(Pagamento::class, Passageiro::class);
    }

    public function pagamentoEvento(Evento $evento){
        return $this->pagamentos()->where("evento_id", $evento->id)->get();
    }
    public function TotalPagoEvento(Evento $evento){
        return $this->pagamentos()->where("evento_id", $evento->id)->sum('valor');
    }
}
