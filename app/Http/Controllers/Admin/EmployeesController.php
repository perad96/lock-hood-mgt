<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Manage employees';
        $this->resources['roleArr'] = $utilityService->getAllUserRoles();
        $this->resources['sectionsArr'] = $utilityService->getAllSectionsWithJobRoles();
        $this->resources['gendersArr'] = $utilityService->getAllGenders();
    }


    public function allView(Request $request)
    {
        try{
            $data = $request->all();
            $this->resources['allArr'] = Employee::with('user', 'section', 'jobRole')
                ->orderBy('id', 'desc')->paginate(10);

            $this->resources['data'] = $data;
            return view('admin.employee_list')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function addView(Request $request)
    {
        try{
            return view('admin.employee_add')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function infoView(Request $request)
    {
        try{
            $obj = Employee::with('user', 'section', 'jobRole')->find($request->id);
            if ($obj != null){
                $this->resources['jobRolesArr'] = $this->utilityService->getJobRolesBySectionId($obj['section_id']);
                $this->resources['obj'] = $obj;
                return view('admin.employee_update')->with($this->resources);
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
            $userId = null;

            $employeeRules = [
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'section' => ['required'],
                'job_role' => ['required'],
                'date_of_birth' => ['required'],
                'gender' => ['required']
            ];

            DB::beginTransaction();
            if ($requestParams['checkUserAccount'] == 'on'){
                $validator = Validator::make($requestParams, [
                    'first_name' => ['required', 'string', 'max:100'],
                    'last_name' => ['required', 'string', 'max:100'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'role' => ['required']
                ], $this->messages());

                if ($validator->fails()) {
                    DB::rollBack();
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }

                $user = new User();
                $user->first_name = $requestParams['first_name'];
                $user->last_name = $requestParams['last_name'];
                $user->email = $requestParams['email'];
                $user->role = $requestParams['role'];
                $user->password = Hash::make($requestParams['password']);
                $user->save();

                $userId = $user->id;

                unset($employeeRules['first_name']);
                unset($employeeRules['last_name']);
                unset($employeeRules['email']);
            }

            $validatorEmployee = Validator::make($requestParams, $employeeRules, $this->messages());
            if (!$validatorEmployee->fails()) {

                Employee::create([
                    'user_id' => $userId,
                    'section_id' => $requestParams['section'],
                    'job_role_id' => $requestParams['job_role'],
                    'first_name' => $requestParams['first_name'],
                    'last_name' => $requestParams['last_name'],
                    'date_of_birth' => $requestParams['date_of_birth'],
                    'email' => $requestParams['email'],
                    'phone' => $requestParams['phone'],
                    'gender' => $requestParams['gender']
                ]);

                DB::commit();
                $this->resources['common_msg'] = $this->successWithMessage('Employee added successfully!');
                return redirect()->back()->with($this->resources);
            }else{
                DB::rollBack();
                return redirect()->back()->withErrors($validatorEmployee)->withInput($request->all());
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
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'section' => ['required'],
                'job_role' => ['required'],
                'date_of_birth' => ['required'],
                'gender' => ['required']
            ], $this->messages());

            if (!$validator->fails()) {

                Employee::find($requestParams['id'])->update([
                    'section_id' => $requestParams['section'],
                    'job_role_id' => $requestParams['job_role'],
                    'first_name' => $requestParams['first_name'],
                    'last_name' => $requestParams['last_name'],
                    'date_of_birth' => $requestParams['date_of_birth'],
                    'email' => $requestParams['email'],
                    'phone' => $requestParams['phone'],
                    'gender' => $requestParams['gender']
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Employee updated successfully!');
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
            Employee::find($request->id)->delete();
            $this->resources['common_msg'] = $this->successWithMessage('Employee deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function export(Request $request)
    {
        try {
            $allArr = Employee::with('user', 'section', 'jobRole')->get();

            return Excel::download(new EmployeeExport($allArr), 'employees.xlsx');

        } catch (\Exception $e) {
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    protected function messages()
    {
        return [
            'first_name.required' => 'Please enter first name.',
            'last_name.required' => 'Please enter last name.',
            'first_name.max' => 'First name may not be greater than 100 characters.',
            'last_name.max' => 'Last name may not be greater than 100 characters.',
            'email.unique' => 'This email is already connected to an account.'
        ];
    }

}
