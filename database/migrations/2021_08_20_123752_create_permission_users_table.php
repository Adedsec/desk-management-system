<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_user_id');
            $table->unsignedBigInteger('desk_id');
            $table->timestamps();


            $table->foreign('permission_user_id')
                ->references('id')
                ->on('permission_user')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('desk_id')
                ->references('id')
                ->on('desks')
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
        Schema::dropIfExists('permission_users');
    }
}
