<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHeadproofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headproofs', function (Blueprint $table) {
            // Cabeza de Comprobante

            $table->id();
            $table->enum('type_movement', ['Compra', 'Venta']);
            $table->date('date_movement');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = OFF');
        Schema::dropIfExists('headproofs');
        DB::statement('SET FOREIGN_KEY_CHECKS = ON');
    }
}
