<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nameArticle')->nullable();
            $table->float('priceArticle')->nullable();
            $table->integer('stockMinArticle')->nullable();
            $table->integer('stockMaxArticle')->nullable();
            $table->date('dateExpirationArt');

            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
        DB::statement('SET FOREIGN_KEY_CHECKS = ON');
    }
}
