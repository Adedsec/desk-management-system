<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('desk_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('task_list_id')->nullable();
            $table->boolean('checked')->default(false);
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->integer('order');
            $table->integer('progress')->default(0);
            $table->unsignedBigInteger('check_list_id')->nullable();
            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('desk_id')
                ->references('id')
                ->on('desks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('task_list_id')
                ->references('id')
                ->on('task_lists')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('check_list_id')
                ->references('id')
                ->on('check_lists')
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
        Schema::dropIfExists('tasks');
    }
}
