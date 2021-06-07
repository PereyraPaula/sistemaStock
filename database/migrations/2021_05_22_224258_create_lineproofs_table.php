<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreign('article_id')->references('id')->on('articles');

            $table->integer('quantity_movement');
            $table->float('amount_movement');

            $table->unsignedBigInteger('headproof_id');
            $table->foreign('headproof_id')->references('id')->on('headproofs');

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
        Schema::dropIfExists('lineproofs');
    }
}
