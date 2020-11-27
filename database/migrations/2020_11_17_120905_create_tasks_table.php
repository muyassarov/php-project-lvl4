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
        $defaultTaskStatus = app('db')->table('task_statuses')
            ->select('id')
            ->where('name', 'New')
            ->first();

        Schema::create('tasks', function (Blueprint $table) use ($defaultTaskStatus) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('status_id')->default($defaultTaskStatus->id);
            $table->bigInteger('created_by_id');
            $table->bigInteger('assigned_to_id')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
