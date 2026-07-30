<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalLeavesTable extends Migration
{
    public function up()
    {
        Schema::create('medical_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employment_bond_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason')->nullable(); // Ex: CID ou descrição opcional (ex: "Cirurgia", "Tratamento de saúde")
            $table->timestamps();

            // Chave estrangeira ligando ao vínculo do funcionário
            $table->foreign('employment_bond_id')
                  ->references('id')
                  ->on('employment_bonds')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_leaves');
    }
}