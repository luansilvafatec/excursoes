<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("titulo_completo");
            $table->string("descricao_curta");
            $table->text("descricao_longa");
            $table->string("foto_card")->nullable();
            $table->string("capa")->nullable();
            $table->integer("vagas")->nullable();
            $table->integer("meta_vagas")->nullable();
            $table->float("valor")->nullable();
            $table->float("pagamento_minimo")->nullable();
            $table->integer("dias_reserva")->default(7);
            $table->string("pagamento_pix_chave")->nullable();
            $table->string("pagamento_pix_envio_comprovante")->nullable();
            $table->date("pagamento_data_fim")->nullable();
            $table->boolean("ingresso_incluso")->default(false);
            $table->string("ingresso_link_compra")->nullable();
            $table->text("ingresso_texto")->nullable();
            $table->date("data_inscricao_inicio");
            $table->date("data_inscricao_fim")->nullable();
            $table->date("data_inicio");
            $table->date("data_fim")->nullable();
            $table->time("hora_saida")->nullable();
            $table->time("hora_chegada")->nullable();
            $table->time("hora_pos_saida")->nullable();
            $table->time("hora_pos_chegada")->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
