<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_shop', function (Blueprint $table) {
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('stars');
            $table->text('comment');
            $table->timestamps();
            // 複合主キー
            $table->primary(['shop_id', 'user_id']);

            // 外部キー制約
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_shop');
    }
}
