<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLineproofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineproofs', function (Blueprint $table) {
            // RENGLONES DEL COMPROBANTE
            $table->id();
            
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            $table->integer('quantity_movement');
            $table->float('amount_movement');

            $table->unsignedBigInteger('headproof_id');
            $table->foreign('headproof_id')->references('id')->on('headproofs')->onDelete('cascade');

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
        Schema::dropIfExists('lineproofs');
        DB::statement('SET FOREIGN_KEY_CHECKS = ON');
    }
}
