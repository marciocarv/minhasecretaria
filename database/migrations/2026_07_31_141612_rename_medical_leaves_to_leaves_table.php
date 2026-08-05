<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMedicalLeavesToLeavesTable extends Migration
{
    public function up()
    {
        // 1. Renomeia a tabela de medical_leaves para leaves (ou o nome que preferir em inglês)
        Schema::rename('medical_leaves', 'leaves');

        // 2. Adiciona a coluna 'type' para diferenciar o afastamento
        Schema::table('leaves', function (Blueprint $table) {
            // Colocamos um valor padrão 'medical' para não quebrar os registros antigos
            $table->string('type')->default('medical')->after('employee_id'); 
        });
    }

    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::rename('leaves', 'medical_leaves');
    }
}