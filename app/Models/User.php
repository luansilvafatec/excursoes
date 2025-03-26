<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsToMany(Evento::class, 'passageiros', 'user_id', 'evento_id')->orderBy('data_inicio', 'desc');
    }

    public function passageiros(): HasMany
    {
        return $this->hasMany(Passageiro::class);
    }
    public function passageiroEvento(Evento $evento)
    {
        return $this->passageiros()->where("evento_id", $evento->id)->first();
    }
    public function esperaEvento(Evento $evento)
    {
        return $this->passageiros()->select('espera')->where("evento_id", $evento->id)->first()->espera;
    }

    public function pagamentos(): HasManyThrough
    {
        //return $this->hasManyThrough(Pagamento::class, Passageiro::class);
        return $this->through('passageiros')->has('pagamentos')->orderBy("id", "desc");
    }

    public function pagamentoEvento(Evento $evento)
    {
        return $this->pagamentos()->where("evento_id", $evento->id)->get();
    }
    public function totalPagoEvento(Evento $evento)
    {
        return $this->pagamentos()->where("evento_id", $evento->id)->sum('valor');
    }
    public function totalPagoDescontoEvento(Evento $evento)
    {
        return $this->pagamentos()->where("evento_id", $evento->id)->sum('valor') + $this->totalDescontoEvento($evento);
    }
    public function totalDescontoEvento(Evento $evento)
    {
        return $this->passageiroEvento($evento)->desconto;
    }
    public function possuiDescontoTotal(Evento $evento)
    {
        return $this->passageiroEvento($evento)->desconto >= $evento->valor;
    }
    public function totalFaltaEvento(Evento $evento)
    {
        return $evento->valor - $this->totalPagoDescontoEvento($evento);
    }
    public function totalPercentEvento(Evento $evento)
    {
        if(($evento->valor - $this->totalDescontoEvento($evento)) == 0){
            return 100;
        }

        return $this->totalPagoEvento($evento) / ($evento->valor - $this->totalDescontoEvento($evento)) * 100;
    }
    public function totalPagoEventoFormatado(Evento $evento)
    {
        return number_format($this->TotalPagoEvento($evento), 2, ',', '.');
    }
    public function totalDescontoEventoFormatado(Evento $evento)
    {
        return number_format($this->totalDescontoEvento($evento), 2, ',', '.');
    }
    public function totalFaltaEventoFormatado(Evento $evento)
    {
        return number_format($this->totalFaltaEvento($evento), 2, ',', '.');
    }

    public function statusEvento(Evento $evento)
    {
        if($this->passageiros()->where("evento_id", $evento->id)->count() == 0){
            return 0;
        }

        if ($this->totalPagoDescontoEvento($evento) >= $evento->valor) {
            return 1;
        }
        if ($this->totalPagoEvento($evento) > 0) {
            return 2;
        }
        if ($this->totalPagoEvento($evento) == 0 && $this->esperaEvento($evento) == 1) {
            return 3;
        }

        return 4;
    }
    public function statusEventoFormatado(Evento $evento)
    {
        switch ($this->statusEvento($evento)) {
            case 1:
                return ["Quitado", "Está tudo certo, basta aguardar o dia da sua viagem e curtir!"];
                break;

            case 2:
                return ["Parcial", "Você pagou uma parte, mas não esqueça de pagar o restante da viagem. Não deixe para a última hora!"];
                break;

            case 3:
                return ["Espera", "Sabemos que você quer muito ir nessa viagem, mas estamos sem vagas. Te avisaremos assim que uma oportunidade surgir."];
                break;

            case 4:
                return ["Pré Reserva", "Vamos segurar sua vaga por alguns dias, mas você precisa realizar um pagamento para garantir que vai na viagem."];
                break;
        }
    }

    public function ateReservaFormatado(Evento $evento)
    {
        // Supondo que $this->created_at seja um objeto Carbon ou uma data no formato aceito por Carbon
        $createdAt = $this->passageiros()->where("evento_id", $evento->id)->first()->updated_at;

        // Cria uma instância do Carbon a partir da data
        $date = Carbon::parse($createdAt);

        // Adiciona x dias à data
        $date->addDays($evento->dias_reserva);

        // Formata a data no formato 'd/m/Y H:i'
        $formattedDate = $date->format('d/m/Y H:i');

        return $formattedDate;
    }

    public function getPrimeiroNomeAttribute()
    {
        // Obtém o valor do campo 'nome_social', se não estiver vazio, retorna o primeiro nome
        if (!empty($this->attributes['nome_social'])) {
            return strtok($this->attributes['nome_social'], ' ');
        }

        // Se 'nome_social' estiver vazio, tenta o campo 'nome'
        if (!empty($this->attributes['nome'])) {
            return strtok($this->attributes['nome'], ' ');
        }

        // Retorna null se nenhum nome estiver disponível
        return null;
    }
    public function getNomeFormatadoAttribute()
    {
        // Obtém o valor do campo 'nome_social', se não estiver vazio, retorna o primeiro nome
        if (!empty($this->attributes['nome_social'])) {
            return $this->attributes['nome_social'];
        }

        // Se 'nome_social' estiver vazio, tenta o campo 'nome'
        if (!empty($this->attributes['nome'])) {
            return $this->attributes['nome'];
        }

        // Retorna null se nenhum nome estiver disponível
        return null;
    }

    public function getTipoFormatadoAttribute(){

        switch ($this->tipo) {
            case 1:
                return "Aluno Fatec";
            break;
            case 2:
                return "Aluno ETEC";
            break;
            case 3:
                return "Ex-Aluno Fatec";
            break;
            case 4:
                return "Ex-Aluno ETEC";
            break;
            case 5:
                return "Comunidade Externa";
            break;

            default:
                return "Inválido";
            break;
        }

    }
}
