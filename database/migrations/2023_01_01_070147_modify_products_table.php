<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('qty')->nullable()->after('description');
            $table->integer('min_qty_notify_level')->nullable()->after('qty');
            $table->string('barcode')->nullable()->after('min_qty_notify_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('qty');
            $table->dropColumn('min_qty_notify_level');
            $table->dropColumn('barcode');
        });
    }
}
