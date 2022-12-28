<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
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
            $validator = Validator::make($requestParams, [
                'category' => ['required'],
                'brand' => ['required'],
                'unit' => ['required'],
                'item_name' => ['required', 'string', 'max:100'],
                'sku' => ['required', 'string', 'max:100'],
                'qty' => ['required', 'numeric'],
                'min_qty_notify_level' => ['required', 'numeric'],
                'lot_number' => ['max:100'],
                'barcode' => ['max:200', 'unique:raw_materials'],
                'description' => ['max:1000'],
                'purchase_unit_price' => ['required', 'numeric'],
            ], $this->messages());

            if (!$validator->fails()) {

                Employee::create([
                    'category_id' => $requestParams['category'],
                    'brand_id' => $requestParams['brand'],
                    'unit_id' => $requestParams['unit'],
                    'item_name' => $requestParams['item_name'],
                    'sku' => $requestParams['sku'],
                    'qty' => $requestParams['qty'],
                    'min_qty_notify_level' => $requestParams['min_qty_notify_level'],
                    'lot_number' => $requestParams['lot_number'],
                    'barcode' => $requestParams['barcode'],
                    'description' => $requestParams['description'],
                    'purchase_unit_price' => $requestParams['purchase_unit_price'],
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Material added successfully!');
                return redirect()->back()->with($this->resources);
            }else{
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function update(Request $request)
    {
        try{
            $requestParams = $request->all();
            $validator = Validator::make($requestParams, [
                'category' => ['required'],
                'brand' => ['required'],
                'unit' => ['required'],
                'item_name' => ['required', 'string', 'max:100'],
                'sku' => ['required', 'string', 'max:100'],
                'qty' => ['required', 'numeric'],
                'min_qty_notify_level' => ['required', 'numeric'],
                'lot_number' => ['max:100'],
//                'barcode' => ['max:200', 'unique:raw_materials'],
                'barcode' => ['max:200'],
                'description' => ['max:1000'],
                'purchase_unit_price' => ['required', 'numeric'],
            ], $this->messages());

            if (!$validator->fails()) {

                Employee::find($requestParams['id'])->update([
                    'category_id' => $requestParams['category'],
                    'brand_id' => $requestParams['brand'],
                    'unit_id' => $requestParams['unit'],
                    'item_name' => $requestParams['item_name'],
                    'sku' => $requestParams['sku'],
                    'qty' => $requestParams['qty'],
                    'min_qty_notify_level' => $requestParams['min_qty_notify_level'],
                    'lot_number' => $requestParams['lot_number'],
                    'barcode' => $requestParams['barcode'],
                    'description' => $requestParams['description'],
                    'purchase_unit_price' => $requestParams['purchase_unit_price'],
                    'expire_date' => $requestParams['expire_date'],
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Material updated successfully!');
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
            $this->resources['common_msg'] = $this->successWithMessage('Material deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function export(Request $request)
    {
        try {
            $allArr = Employee::with('user', 'section', 'job_role')->get();

            return Excel::download(new EmployeeExport($allArr), 'employees.xlsx');

        } catch (\Exception $e) {
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    protected function messages()
    {
        return [
            'category.required' => 'Please select category.',
            'brand.required' => 'Please select brand.',
            'unit.required' => 'Please select unit.',
            'item_name.required' => 'Please enter item name.',
            'sku.required' => 'Please enter SKU.',
            'qty.required' => 'Please enter QTY.',
            'qty.number' => 'Invalid qty',
            'min_qty_notify_level.number' => 'Invalid min qty notify level',
            'purchase_price.required' => 'Please enter purchase price',
//
//            'first_name.max' => 'First name may not be greater than 100 characters.',
//            'last_name.max' => 'Last name may not be greater than 100 characters.',
//            'email.unique' => 'This email is already connected to an account.'
        ];
    }

}
