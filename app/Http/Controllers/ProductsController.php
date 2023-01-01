<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Product;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Manage products';
    }

    public function allView(Request $request)
    {
        try{
            $data = $request->all();
            $this->resources['allArr'] = Product::orderBy('id', 'desc')->paginate(10);

            $this->resources['data'] = $data;
            return view('admin.product_list')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function addView(Request $request)
    {
        try{
            return view('admin.product_add')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function infoView(Request $request)
    {
        try{
            $obj = Product::find($request->id);
            if ($obj != null){
                $this->resources['obj'] = $obj;
                return view('admin.product_update')->with($this->resources);
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
                'name' => ['required', 'string', 'max:100'],
                'qty' => ['required', 'numeric'],
                'min_qty_notify_level' => ['required', 'numeric'],
                'barcode' => ['max:200', 'unique:products'],
                'description' => ['max:1000'],
                'unit_price' => ['required', 'numeric'],
            ], $this->messages());

            if (!$validator->fails()) {

                Product::create([
                    'name' => $requestParams['name'],
                    'qty' => $requestParams['qty'],
                    'min_qty_notify_level' => $requestParams['min_qty_notify_level'],
                    'barcode' => $requestParams['barcode'],
                    'description' => $requestParams['description'],
                    'unit_price' => $requestParams['unit_price'],
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Product added successfully!');
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
                'name' => ['required', 'string', 'max:100'],
                'qty' => ['required', 'numeric'],
                'min_qty_notify_level' => ['required', 'numeric'],
                'barcode' => ['max:200'],
                'description' => ['max:1000'],
                'unit_price' => ['required', 'numeric'],
            ], $this->messages());

            if (!$validator->fails()) {

                Product::find($requestParams['id'])->update([
                    'name' => $requestParams['name'],
                    'qty' => $requestParams['qty'],
                    'min_qty_notify_level' => $requestParams['min_qty_notify_level'],
                    'barcode' => $requestParams['barcode'],
                    'description' => $requestParams['description'],
                    'unit_price' => $requestParams['unit_price'],
                ]);

                $this->resources['common_msg'] = $this->successWithMessage('Product updated successfully!');
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
            Product::find($request->id)->delete();
            $this->resources['common_msg'] = $this->successWithMessage('Product deleted successfully!');
            return redirect()->back()->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function export(Request $request)
    {
        try {
            $allArr = Product::all();

            return Excel::download(new ProductsExport($allArr), 'products.xlsx');

        } catch (\Exception $e) {
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    protected function messages()
    {
        return [
            'name.required' => 'Please enter product name.',
            'qty.number' => 'Invalid qty',
            'min_qty_notify_level.number' => 'Invalid min qty notify level',
            'unit_price.required' => 'Please enter unit price',
        ];
    }
}
