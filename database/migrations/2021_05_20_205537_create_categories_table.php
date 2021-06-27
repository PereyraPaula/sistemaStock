<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla de rubros
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nameCategory');
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
        Schema::dropIfExists('categories');
        DB::statement('SET FOREIGN_KEY_CHECKS = ON');
    }
}
