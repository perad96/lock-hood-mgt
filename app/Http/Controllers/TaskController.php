<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Models\Employee;
use App\Models\RawMaterial;
use App\Models\Task;
use App\Models\TaskMaterial;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Manage tasks';
        $this->resources['statusArr'] = $this->utilityService->getAllTaskStatus();
    }


    public function allView(Request $request)
    {
        try{
            $data = $request->all();
            $this->resources['allArr'] = Task::with('reporter', 'assignee')
                ->orderBy('id', 'desc')->paginate(10);

            $this->resources['data'] = $data;
            return view('admin.task_list')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function addView(Request $request)
    {
        try{
            $this->resources['reporterArr'] = Employee::all();
            $this->resources['assigneeArr'] = Employee::all();
            $this->resources['rawMaterialsArr'] = RawMaterial::orderBy('item_name')->get();

            return view('admin.task_add')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function infoView(Request $request)
    {
        try{
            $obj = Task::with('reporter', 'assignee')->find($request->id);
            if ($obj != null){
                $this->resources['obj'] = $obj;
                return view('admin.task_update')->with($this->resources);
            }else{
                return view('error_pages.404');
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function add(Request $request)
    {
        try{
            $requestParams = $request->all();

            $validator = Validator::make($requestParams, [
                'reporter' => ['required'],
                'assignee' => ['required'],
                'description' => ['required']
            ], $this->messages());

            if (!$validator->fails()) {

                DB::beginTransaction();
                $task = Task::create([
                    'reporter_id' => $requestParams['reporter'],
                    'assignee_id' => $requestParams['assignee'],
                    'description' => $requestParams['description'],
                    'due_date' => $requestParams['due_date'],
                    'started_at' => $requestParams['start_date'],
                    'finished_at' => $requestParams['end_date'],
                    'spend_hours' => $requestParams['spend_hours'],
                    'spend_minutes' => $requestParams['spend_minutes'],
                    'status' => (isset($requestParams['status'])) ? $requestParams['status'] : 'PENDING'
                ]);

                if (count($requestParams['raw_material']) > 0){
                    foreach ($requestParams['raw_material'] as $key => $material){
                        TaskMaterial::create([
                            'task_id' => $task['id'],
                            'material_id' => $material,
                            'qty' => $requestParams['qty'][$key]
                        ]);
                    }
                }

                DB::commit();
                $this->resources['common_msg'] = $this->successWithMessage('Task added successfully!');
                return redirect()->back()->with($this->resources);
            }else{
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }catch (\Exception $e){
            DB::rollBack();
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function update(Request $request)
    {
        try{
            $requestParams = $request->all();
            $validator = Validator::make($requestParams, [
                'reporter' => ['required'],
                'assignee' => ['required'],
                'description' => ['required']
            ], $this->messages());

            if (!$validator->fails()) {

                Task::find($requestParams['id'])->update([
                    'reporter_id' => $requestParams['reporter'],
                    'assignee_id' => $requestParams['assignee'],
                    'description' => $requestParams['description'],
                    'due_date' => $requestParams['due_date'],
                    'started_at' => $requestParams['start_date'],
                    'finished_at' => $requestParams['end_date'],
                    'spend_hours' => $requestParams['spend_hours'],
                    'spend_minutes' => $requestParams['spend_minutes'],
                    'status' => (isset($requestParams['status'])) ? $requestParams['status'] : 'PENDING'
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Task updated successfully!');
                return redirect()->back()->with($this->resources);
            }else{
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function delete(Request $request)
    {
        try{
            Task::find($request->id)->delete();
            $this->resources['common_msg'] = $this->successWithMessage('Task deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function export(Request $request)
    {
        try {
            $allArr = Task::all();

            return Excel::download(new TasksExport($allArr), 'tasks.xlsx');

        } catch (\Exception $e) {
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    protected function messages()
    {
        return [
            'description.required' => 'Please enter description.',
        ];
    }
}
