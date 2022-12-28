<?php

use App\Models\JobRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('name');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
        });

        JobRole::insert([
            [ 'section_id'=> 1, 'name' => 'Sales Manager' ],
            [ 'section_id'=> 1, 'name' => 'Marketing Manager' ],
            [ 'section_id'=> 1, 'name' => 'Sales Representative' ],
            [ 'section_id'=> 1, 'name' => 'Marketing Executive' ],
            [ 'section_id'=> 1, 'name' => 'Supervisor' ],

            [ 'section_id'=> 2, 'name' => 'Store Keeper' ],
            [ 'section_id'=> 2, 'name' => 'Purchasing Manager' ],
            [ 'section_id'=> 2, 'name' => 'Supervisor' ],

            [ 'section_id'=> 3, 'name' => 'Finance Manager' ],
            [ 'section_id'=> 3, 'name' => 'Accountant' ],
            [ 'section_id'=> 3, 'name' => 'Treasurer' ],
            [ 'section_id'=> 3, 'name' => 'Supervisor' ],

            [ 'section_id'=> 4, 'name' => 'IT Manager' ],
            [ 'section_id'=> 4, 'name' => 'IT Support Engineer' ],
            [ 'section_id'=> 4, 'name' => 'Supervisor' ],

            [ 'section_id'=> 5, 'name' => 'HR Manager' ],
            [ 'section_id'=> 5, 'name' => 'Recruit Executive' ],
            [ 'section_id'=> 5, 'name' => 'Supervisor' ],

            [ 'section_id'=> 6, 'name' => 'R&D Head' ],
            [ 'section_id'=> 6, 'name' => 'R&D Specialist' ],
            [ 'section_id'=> 6, 'name' => 'Supervisor' ],

            [ 'section_id'=> 7, 'name' => 'Engineering Design Manager' ],
            [ 'section_id'=> 7, 'name' => 'Lead Engineering Design' ],
            [ 'section_id'=> 7, 'name' => 'Engineering & Factory Manager' ],
            [ 'section_id'=> 7, 'name' => 'Supervisor' ],


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_roles');
    }
}
