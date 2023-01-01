<?php

use App\Models\Section;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Section::insert([
            [ 'id'=> 1, 'name' => 'Sales & Marketing' ],
            [ 'id'=> 2, 'name' => 'Purchasing' ],
            [ 'id'=> 3, 'name' => 'Finance' ],
            [ 'id'=> 4, 'name' => 'IT' ],
            [ 'id'=> 5, 'name' => 'HR' ],
            [ 'id'=> 6, 'name' => 'R&D' ],
            [ 'id'=> 7, 'name' => 'Engineering Design' ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
