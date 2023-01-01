<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListedTaskMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listed_task_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listed_task_id');
            $table->unsignedBigInteger('material_id');
            $table->double('qty');
            $table->timestamps();

            $table->foreign('listed_task_id')->references('id')->on('listed_tasks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('raw_materials')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listed_task_materials');
    }
}
