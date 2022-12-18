<?php

use App\Models\MaterialBrand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        MaterialBrand::insert([
            [ 'name' => 'Prime Gold' ],
            [ 'name' => 'Steel Authority of Australia Limited (SAAL)' ],
            [ 'name' => 'Bhushan Steel' ],
            [ 'name' => 'Jindal Steel & Power' ],
            [ 'name' => 'The Pickleson Paint Co' ],
            [ 'name' => 'Sanderson' ],
            [ 'name' => 'Cox & Cox' ],
            [ 'name' => 'PolyOne' ],
            [ 'name' => 'Sinopec' ],
            [ 'name' => 'Indorama Ventures' ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_brands');
    }
}
