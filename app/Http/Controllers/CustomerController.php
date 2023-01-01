<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Models\Customer;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Manage customers';
    }


    public function allView(Request $request)
    {
        try{
            $data = $request->all();
            $this->resources['allArr'] = Customer::orderBy('id', 'desc')->paginate(10);

            $this->resources['data'] = $data;
            return view('admin.customer_list')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function addView(Request $request)
    {
        try{
            return view('admin.customer_add')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function infoView(Request $request)
    {
        try{
            $obj = Customer::find($request->id);
            if ($obj != null){
                $this->resources['obj'] = $obj;
                return view('admin.customer_update')->with($this->resources);
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
                'company_name' => ['string', 'max:100'],
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['string', 'max:100'],
                'phone' => ['string', 'max:100'],
                'mobile' => ['string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255']
            ], $this->messages());

            if (!$validator->fails()) {

                Customer::create([
                    'company_name' => $requestParams['company_name'],
                    'first_name' => $requestParams['first_name'],
                    'last_name' => $requestParams['last_name'],
                    'phone' => $requestParams['phone'],
                    'mobile' => $requestParams['mobile'],
                    'email' => $requestParams['email']
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Customer added successfully!');
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
                'company_name' => ['string', 'max:100'],
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['string', 'max:100'],
                'phone' => ['string', 'max:100'],
                'mobile' => ['string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255']
            ], $this->messages());

            if (!$validator->fails()) {

                Customer::find($requestParams['id'])->update([
                    'company_name' => $requestParams['company_name'],
                    'first_name' => $requestParams['first_name'],
                    'last_name' => $requestParams['last_name'],
                    'phone' => $requestParams['phone'],
                    'mobile' => $requestParams['mobile'],
                    'email' => $requestParams['email']
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Customer updated successfully!');
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
            Customer::find($request->id)->delete();
            $this->resources['common_msg'] = $this->successWithMessage('Customer deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function export(Request $request)
    {
        try {
            $allArr = Customer::all();

            return Excel::download(new CustomerExport($allArr), 'customers.xlsx');

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
        ];
    }
}
