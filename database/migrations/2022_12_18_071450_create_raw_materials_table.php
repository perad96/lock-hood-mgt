<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('sku')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('min_qty_notify_level')->nullable();
            $table->string('lot_number')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('barcode')->nullable();
            $table->text('description')->nullable();
            $table->decimal('purchase_unit_price')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('material_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('material_brands')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_materials');
    }
}
