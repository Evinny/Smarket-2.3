<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMarketLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_market_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedbiginteger('produto_id');
            $table->unsignedbiginteger('market_id');
            
            $table->integer('amount_requested');
            $table->integer('amount_left');
            $table->integer('total_price');
        });

        schema::table('product_market_logs', function(blueprint $table){
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        schema::table('product_market_logs', function(blueprint $table){
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
        schema::table('product_market_logs', function(blueprint $table){
            $table->dropforeign('product_market_logs_market_id_foreign');
            $table->dropforeign('product_market_logs_produto_id_foreign');
        });
        
        
        Schema::dropIfExists('product_market_logs');
    }
}
