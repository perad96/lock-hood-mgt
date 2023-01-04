<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdColToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable()->after('assignee_id');

            $table->foreign('order_id')->references('id')->on('customer_orders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }
}
