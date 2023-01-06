<?php

namespace App\Http\Controllers;

use App\Exports\CustomerOrdersExport;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderDetail;
use App\Models\Product;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CustomerOrderController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Manage customer orders';
        $this->resources['customersArr'] = $this->utilityService->getAllCustomers();
        $this->resources['orderTypesArr'] = $this->utilityService->getAllOrderTypes();
        $this->resources['statusArr'] = $this->utilityService->getAllStatus();
    }


    public function allView(Request $request)
    {
        try{
            $data = $request->all();
            $this->resources['allArr'] = CustomerOrder::with('customer')
                ->orderBy('id', 'desc')->paginate(10);

            $this->resources['data'] = $data;
            return view('admin.customer_order_list')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function addView(Request $request)
    {
        try{
            $this->resources['productsArr'] = Product::all();
            return view('admin.customer_order_add')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function infoView(Request $request)
    {
        try{
            $obj = CustomerOrder::with('customer')->find($request->id);
            if ($obj != null) {
                $this->resources['obj'] = $obj;
                return view('admin.customer_order_update')->with($this->resources);
            }else {
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

            $validator = Validator::make($requestParams, ['order_type' => ['required']], $this->messages());
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }

            if ($requestParams['order_type'] == 'CUSTOM'){
                $validator = Validator::make($requestParams, [
                    'order_type' => ['required'],
                    'customer' => ['required'],
                    'description' => ['required'],
                    'discount_percentage' => ['required'],
                    'sub_total' => ['required'],
                ], $this->messages());

                if (!$validator->fails()) {

                    CustomerOrder::create([
                        'customer_id' => $requestParams['customer'],
                        'order_type' => $requestParams['order_type'],
                        'description' => $requestParams['description'],
                        'order_date' => $requestParams['order_date'],
                        'due_date' => $requestParams['due_date'],
                        'discount_percentage' => $requestParams['discount_percentage'],
                        'sub_total' => $requestParams['sub_total'],
                        'delivery_fee' => $requestParams['delivery_fee'],
                        'status' => 'PENDING'
                    ]);

                    $this->resources['common_msg'] = $this->successWithMessage('Order placed successfully!');
                    return redirect()->back()->with($this->resources);
                }else{
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
            }

            if ($requestParams['order_type'] == 'EXISTING_PRODUCT'){
                $this->resources['common_msg'] = $this->dangerWithMessage('Under construction!');
                return redirect()->back()->with($this->resources)->withInput($request->all());

                $validator = Validator::make($requestParams, [
                    'order_type' => ['required'],
                    'customer' => ['required'],
                    'discount_percentage' => ['required'],
                    'sub_total' => ['required'],
                ], $this->messages());

                if (!$validator->fails()) {

                    DB::beginTransaction();
                    $order = CustomerOrder::create([
                        'customer_id' => $requestParams['customer'],
                        'order_type' => $requestParams['order_type'],
                        'description' => $requestParams['description'],
                        'order_date' => date('Y-m-d'),
                        'due_date' => date('Y-m-d', strtotime($requestParams['due_date'])),
                        'discount_percentage' => $requestParams['discount_percentage'],
                        'sub_total' => $requestParams['sub_total'],
                        'delivery_fee' => $requestParams['delivery_fee'],
                        'status' => 'PENDING'
                    ]);

                    foreach ($requestParams['orderDetails'] as $orderDetail){
                        CustomerOrderDetail::create([
                            'order_id' => $order['id'],
                            'product_id' => $orderDetail['product_id'],
                            'qty' => $orderDetail['qty'],
                            'unit_price' => $orderDetail['unit_price']
                        ]);
                    }

                    DB::commit();
                    $this->resources['common_msg'] = $this->successWithMessage('Order placed successfully!');
                    return redirect()->back()->with($this->resources);
                }else{
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
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

                CustomerOrder::find($requestParams['id'])->update([
                    'company_name' => $requestParams['company_name'],
                    'first_name' => $requestParams['first_name'],
                    'last_name' => $requestParams['last_name'],
                    'phone' => $requestParams['phone'],
                    'mobile' => $requestParams['mobile'],
                    'email' => $requestParams['email']
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('CustomerOrder updated successfully!');
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
            CustomerOrder::find($request->id)->delete();
            $this->resources['common_msg'] = $this->successWithMessage('CustomerOrder deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function export(Request $request)
    {
        try {
            $allArr = CustomerOrder::all();

            return Excel::download(new CustomerOrdersExport($allArr), 'customer_orders.xlsx');

        } catch (\Exception $e) {
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    protected function messages()
    {
        return [
            'order_type.required' => 'Please select order type.',
            'customer.required' => 'Please select customer.',
            'first_name.max' => 'First name may not be greater than 100 characters.',
            'last_name.max' => 'Last name may not be greater than 100 characters.',
        ];
    }
}

