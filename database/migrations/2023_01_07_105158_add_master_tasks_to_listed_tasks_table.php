<?php

use App\Models\ListedTask;
use App\Models\ListedTaskMaterial;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddMasterTasksToListedTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            $dataArr = [
                [
                    'title' => 'Task A',
                    'description' => 'Description A',
                    'materials' => [
                        [ 'material_id' => 1, 'qty' => 2 ],
                        [ 'material_id' => 2, 'qty' => 2 ]
                    ]
                ],[
                    'title' => 'Task B',
                    'description' => 'Description B',
                    'materials' => [
                        [ 'material_id' => 1, 'qty' => 1 ],
                        [ 'material_id' => 2, 'qty' => 4 ]
                    ]
                ]
            ];

            DB::beginTransaction();
            foreach ($dataArr as $data){
                $task = ListedTask::create([
                    'title' => $data['title'],
                    'description' => $data['description']
                ]);

                foreach ($data['materials'] as $material){
                    ListedTaskMaterial::create([
                        'listed_task_id' => $task['id'],
                        'material_id' => $material['material_id'],
                        'qty' => $material['qty']
                    ]);
                }
            }
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();

            dd([
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
