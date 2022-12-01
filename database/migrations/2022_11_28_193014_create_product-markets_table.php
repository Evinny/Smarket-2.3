<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_markets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedbiginteger('produto_id');
            $table->unsignedbiginteger('market_id');
            
            $table->integer('amount_requested');
            $table->integer('amount_sold');
            $table->integer('amount_left');
        });

        schema::table('products_markets', function(blueprint $table){
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        schema::table('products_markets', function(blueprint $table){
            $table->foreign('market_id')->references('id')->on('markets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('products_markets', function(blueprint $table){
            $table->dropforeign('products_markets_market_id_foreign');
            $table->dropforeign('products_markets_produto_id_foreign');
        });
        
        Schema::dropIfExists('products_markets');
    }
}
