<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($evento) {

            // Verificar se venceu a pré reserva de alguem e elimina
            foreach ($evento->interessados as $key => $interessado) {
                // Cria uma instância do Carbon a partir da data
                $date = Carbon::parse($interessado->updated_at);

                // Adiciona 5 dias à data
                $date->addDays(5);

                if($date <= Carbon::now()){
                    $passageiro = Passageiro::find($interessado->id);
                    $passageiro->delete();
                }
            }

            // Verificar se esta na espera e adiciona na reserva
            foreach ($evento->espera as $key => $espera) {

                if($evento->vagas_disponiveis){
                    $passageiro = Passageiro::find($espera->id);
                    $passageiro->espera = 0;
                    $passageiro->updated_at = Carbon::now();
                    $passageiro->save();

                    //salva na tabela notificados para ser avisado
                    $notificado = new Notificado();
                    $notificado->passageiro_id = $passageiro->id;
                    $notificado->save();
                }
            }

        });
    }



    public function user() {
        return $this->belongsTo(User::class);
    }
    public function passageiros() : HasMany {
        return $this->hasMany(Passageiro::class)->where('espera', false);
    }
    public function espera() : HasMany {
        return $this->hasMany(Passageiro::class)->where('espera', true);
    }

    //realizaram a pré reserva
    public function interessados() {
        return $this->passageiros()->whereDoesntHave('pagamentos')->where('desconto','<',$this->valor);
    }
    public function getInteressadosAtribute(){
        return $this->interessados();
    }

    public function confirmados() {
        return $this->passageiros()->get()->filter(function ($passageiro) {
            return $passageiro->total_pago_desconto >= $this->valor;
        });
    }
    public function getConfirmadosAttribute(){
        return $this->confirmados();
    }

    public function parciais() {
        return $this->passageiros()->get()->filter(function ($passageiro) {
            return $passageiro->total_pago_desconto > 0 && $passageiro->total_pago_desconto < $this->valor;
        });
    }

    public function getVagasDisponiveisAttribute() : int {
        return $this->vagas - $this->contagem_passageiros;
    }

    public function getContagemPassageirosAttribute() : int
    {
        return $this->passageiros()->count();
    }
    public function getContagemEsperaAttribute() : int
    {
        return $this->espera()->count();
    }

    public function getContagemInteressadosAttribute(): int {
        return $this->interessados()->count();
    }
    public function getContagemParciaisAttribute(): int {
        return $this->parciais()->count();
    }
    public function getContagemConfirmadosAttribute(): int {
        return $this->confirmados()->count();
    }
    public function getPossuiVagasAttribute(): bool{
        return $this->vagas_disponiveis > 0;
    }

    public function getMesAttribute() : string{
        return strtoupper(Carbon::parse($this->data_inicio)->locale('pt_BR')->translatedFormat('F'));
    }

    public function getDiaSemanaAttribute() : string{
        $diadasemana = Carbon::parse($this->data_inicio)->locale('pt_BR')->translatedFormat('l');
        return str_replace('-feira', '', $diadasemana);
    }

    public function getDiaMesAttribute() : string{
        return strtoupper(Carbon::parse($this->data_inicio)->locale('pt_BR')->translatedFormat('d'));
    }
    public function getValorFormatadoAttribute() : string{
        return number_format($this->valor, 2, ',', '.');
    }
    public function getSaidaFatecFormatadaAttribute() : string{
        return Carbon::parse($this->hora_saida)->format('H\hi');
    }
    public function getChegadaEventoFormatadaAttribute() : string{
        return Carbon::parse($this->hora_chegada)->format('H\hi');
    }
    public function getSaidaEventoFormatadaAttribute() : string{
        return Carbon::parse($this->hora_pos_saida)->format('H\hi');
    }
    public function getChegadaFatecFormatadaAttribute() : string{
        return Carbon::parse($this->hora_pos_chegada)->format('H\hi');
    }
}
