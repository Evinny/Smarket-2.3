<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('size', 50);
            $table->string('type', 80);
            $table->integer('products_delivered')->default(0);
            $table->integer('products_available')->default(0);   
        });

        schema::table('produtos', function(blueprint $table){
            $table->foreign('providers_id')->references('id')->on('providers');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (blueprint $table){
            $table->dropforeign('produtos_providers_id_foreign');
        });

        Schema::dropIfExists('providers');
    }
}
