<?php

namespace App\Http\Controllers\Admin;

use App\Exports\IncomeExport;
use App\Exports\MostWantedMaterialExport;
use App\Exports\OrderDeliveryCostExport;
use App\Exports\TasksExport;
use App\Exports\TopSellingProductExport;
use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderDetail;
use App\Models\Task;
use App\Models\TaskMaterial;
use App\Services\UtilityService;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    use Messages;
    protected $resources = [];
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;

        $this->resources['page_title'] = 'Reports';
        $this->resources['brandsArr'] = $utilityService->getAllRawMaterialBrands();
        $this->resources['categoriesArr'] = $utilityService->getAllRawMaterialCategories();
        $this->resources['unitsArr'] = $utilityService->getAllUnits();
    }


    public function index(Request $request)
    {
        try{
            return view('admin.report_index')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function incomeView(Request $request)
    {
        try{
            $data = $request->all();

            $result = [];
            if (isset($data['month'])){
                $year = date('Y', strtotime($data['month']));
                $month = date('m', strtotime($data['month']));
                $result = $this->getIncomeReportData($year, $month);
            }

            $this->resources['allArr'] = $result;
            $this->resources['data'] = $data;

            return view('admin.report_income')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function taskView(Request $request)
    {
        try{
            $data = $request->all();

            $result = [];
            if (isset($data['month'])){
                $year = date('Y', strtotime($data['month']));
                $month = date('m', strtotime($data['month']));
                $result = $this->getTaskReportData($year, $month);
            }

            $this->resources['allArr'] = $result;
            $this->resources['data'] = $data;

            return view('admin.report_task')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function topSellingProductView(Request $request)
    {
        try{
            $data = $request->all();

            $result = [];
            if (isset($data['month'])){
                $year = date('Y', strtotime($data['month']));
                $month = date('m', strtotime($data['month']));
                $result = $this->getTopSellingProductData($year, $month);
            }

            $this->resources['allArr'] = $result;
            $this->resources['data'] = $data;

            return view('admin.report_top_selling_product')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function mostWantedMaterialView(Request $request)
    {
        try{
            $data = $request->all();

            $result = [];
            if (isset($data['month'])){
                $year = date('Y', strtotime($data['month']));
                $month = date('m', strtotime($data['month']));
                $result = $this->getMostWantedMaterialData($year, $month);
            }

            $this->resources['allArr'] = $result;
            $this->resources['data'] = $data;

            return view('admin.report_most_wanted_material')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }


    public function orderDeliveryCostView(Request $request)
    {
        try{
            $data = $request->all();

            $result = [];
            if (isset($data['month'])){
                $year = date('Y', strtotime($data['month']));
                $month = date('m', strtotime($data['month']));
                $result = $this->getOrderDeliveryCostData($year, $month);
            }

            $this->resources['allArr'] = $result;
            $this->resources['data'] = $data;

            return view('admin.report_order_delivery_cost')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function incomeExport(Request $request)
    {
        try{
            $data = $request->all();

            $year = date('Y', strtotime($data['month']));
            $month = date('m', strtotime($data['month']));
            $allArr = $this->getIncomeReportData($year, $month);

            return Excel::download(new IncomeExport($allArr), 'income_report.xlsx');

        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function taskExport(Request $request)
    {
        try{
            $data = $request->all();

            $year = date('Y', strtotime($data['month']));
            $month = date('m', strtotime($data['month']));
            $allArr = $this->getTaskReportData($year, $month);

            return Excel::download(new TasksExport($allArr), 'task_report.xlsx');

        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function topSellingProductExport(Request $request)
    {
        try{
            $data = $request->all();

            $year = date('Y', strtotime($data['month']));
            $month = date('m', strtotime($data['month']));
            $allArr = $this->getTopSellingProductData($year, $month);

            return Excel::download(new TopSellingProductExport($allArr), 'top_selling_products_report.xlsx');

        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function mostWantedMaterialExport(Request $request)
    {
        try{
            $data = $request->all();

            $year = date('Y', strtotime($data['month']));
            $month = date('m', strtotime($data['month']));
            $allArr = $this->getMostWantedMaterialData($year, $month);

            return Excel::download(new MostWantedMaterialExport($allArr), 'most_wanted_materials_report.xlsx');

        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }

    public function orderDeliveryCostExport(Request $request)
    {
        try{
            $data = $request->all();

            $year = date('Y', strtotime($data['month']));
            $month = date('m', strtotime($data['month']));
            $allArr = $this->getOrderDeliveryCostData($year, $month);

            return Excel::download(new OrderDeliveryCostExport($allArr), 'order_delivery_cost_report.xlsx');

        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }


    protected function getIncomeReportData($year, $month){
        return CustomerOrder::selectRaw(
            'order_date, SUM(sub_total) as sub_total_sum,
            SUM(delivery_fee) as delivery_fee_sum, COUNT(id) as order_count,
            COUNT(DISTINCT("CUSTOM")) as custom_order_count,
            COUNT(DISTINCT("EXISTING_PRODUCT")) as product_order_count'
        )
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->where('status', 'COMPLETE')->groupBy('order_date')->get();
    }

    protected function getTaskReportData($year, $month){
        $result = Task::selectRaw(
            'DATE(created_at) as new_date,
            COUNT(id) as task_count,
            SUM(spend_hours) as hours_sum,
            SUM(spend_minutes) as minutes_sum,
            COUNT(id) as task_count,
            COUNT(DISTINCT("PENDING")) as pending_count,
            COUNT(DISTINCT("COMPLETED")) as completed_count'
        )
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('new_date')->get();

        $resp = [];
        foreach ($result as $data){
            $minutes = $data['minutes_sum'];
            $newTime = intdiv($minutes, 60).':'. ($minutes % 60);
            $newHours = explode(':',$newTime)[0];

            $obj = [];
            $obj['date'] = $data['new_date'];
            $obj['task_count'] = $data['task_count'];
            $obj['hours'] = $data['hours_sum'] + $newHours;
            $obj['minutes'] = explode(':',$newTime)[1];
            $obj['pending_count'] = $data['pending_count'];
            $obj['completed_count'] = $data['completed_count'];
            $resp[] = $obj;
        }

        return $resp;
    }

    protected function getTopSellingProductData($year, $month){
        $orderIdArr = CustomerOrder::where('order_type', 'EXISTING_PRODUCT')
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->pluck('id')->toArray();

        $result = CustomerOrderDetail::selectRaw('SUM(qty) as qty_sum, product_id')->with('product')
            ->whereIn('order_id', $orderIdArr)
            ->groupBy('product_id')->get();

        $resp = [];
        foreach ($result as $data){
            $obj = [];
            $obj['product'] = $data['product']['name'];
            $obj['qty'] = $data['qty_sum'];
            $resp[] = $obj;
        }

        return $resp;
    }

    protected function getMostWantedMaterialData($year, $month){
        $taskIdArr = Task::whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->pluck('id')->toArray();

        $result = TaskMaterial::selectRaw('SUM(qty) as qty_sum, material_id')->with('rawMaterial')
            ->whereIn('task_id', $taskIdArr)
            ->groupBy('material_id')->get();

        $resp = [];
        foreach ($result as $data){
            $obj = [];
            $obj['product'] = $data['rawMaterial']['item_name'];
            $obj['available_qty'] = $data['rawMaterial']['qty'];
            $obj['qty'] = $data['qty_sum'];
            $resp[] = $obj;
        }

        return $resp;
    }

    protected function getOrderDeliveryCostData($year, $month){
        $result = CustomerOrder::selectRaw(
            'DATE(created_at) as new_date,
            COUNT(id) as order_count,
            SUM(delivery_fee) as delivery_fee_sum'
        )
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('new_date')->get();


        $resp = [];
        foreach ($result as $data){
            $obj = [];
            $obj['date'] = $data['new_date'];
            $obj['order_count'] = $data['order_count'];
            $obj['delivery_fee_sum'] = $data['delivery_fee_sum'];
            $resp[] = $obj;
        }

        return $resp;
    }



//$orderAmountSum = CustomerOrder::selectRaw('
//                        YEAR(order_date) year, MONTH(order_date) month,
//                        SUM(sub_total) as sub_total_sum,
//                        SUM(delivery_fee) as delivery_fee_sum,
//                    ')
//->whereMonth('order_date', $month)
//->whereYear('order_date', $year)
//->where('status', 'COMPLETE')->groupBy('order_date')->get();
}
