<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('spend_hours')->nullable()->after('description');
            $table->integer('spend_minutes')->nullable()->after('spend_hours');
            $table->date('due_date')->nullable()->after('spend_minutes');
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
            $table->dropColumn('spend_hours');
            $table->dropColumn('spend_minutes');
            $table->dropColumn('due_date');
        });
    }
}
