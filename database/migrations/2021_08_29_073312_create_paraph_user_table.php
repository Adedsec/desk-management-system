<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParaphUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paraph_user', function (Blueprint $table) {
            $table->unsignedBigInteger('paraph_id');
            $table->unsignedBigInteger('user_id');


            $table->primary(['paraph_id', 'user_id']);


            $table->foreign('paraph_id')
                ->references('id')
                ->on('paraphs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paraph_user');
    }
}
