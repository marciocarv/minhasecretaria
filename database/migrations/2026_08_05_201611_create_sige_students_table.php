<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSigeStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sige_students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class_name')->nullable(); // Turma do aluno
            
            // Campos Específicos dos Relatórios
            $table->string('transport_route')->nullable(); // Se for nulo, não usa transporte
            $table->string('special_need')->nullable(); // Se for nulo, não tem necessidade especial
            $table->boolean('has_bolsa_familia')->default(false); // Verdadeiro ou Falso
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sige_students');
    }
}
