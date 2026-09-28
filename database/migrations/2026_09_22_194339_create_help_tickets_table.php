<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('help_tickets', function (Blueprint $table) {
        $table->id();
        $table->string('responsible');
        $table->enum('subject', ['Sige', 'Sim palmas', 'Email institucional', 'Censo escolar']);
        $table->text('report');
        $table->enum('status', ['Solicitado', 'Atendido', 'Finalizado'])->default('Solicitado');
        $table->timestamp('attended_at')->nullable();
        $table->timestamp('finished_at')->nullable();
        $table->timestamps(); // Cria o created_at (Data da Solicitação) e updated_at
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_tickets');
    }
}
