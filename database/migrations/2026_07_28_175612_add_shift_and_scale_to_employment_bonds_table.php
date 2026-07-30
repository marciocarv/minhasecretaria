<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShiftAndScaleToEmploymentBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employment_bonds', function (Blueprint $table) {
            // Define o turno de trabalho geral do vínculo
            $table->string('work_shift')->nullable()->after('workload'); 
            
            // Usado APENAS para calcular os dias corretos em escalas 12x36
            $table->date('scale_start_date')->nullable()->after('work_shift'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employment_bonds', function (Blueprint $table) {
            $table->dropColumn(['work_shift', 'scale_start_date']);
        });
    }
}