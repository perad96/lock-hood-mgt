<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Task;
use App\Services\UtilityService;
use App\Traits\Messages;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    protected $utilityService;

    public function __construct(
        UtilityService $utilityService
    ){
        $this->utilityService = $utilityService;
    }

    public function getJobRolesBySectionId(Request $request)
    {
        return $this->utilityService->getJobRolesBySectionId($request->id);
    }

    public function getAllCustomers(Request $request)
    {
        return $this->utilityService->getAllCustomers();
    }

    public function getRawMaterialById(Request $request)
    {
        return $this->utilityService->getRawMaterialById($request->id);
    }

    public function getRawMaterialsByListedTask(Request $request)
    {
        return $this->utilityService->getRawMaterialsByListedTask($request->id);
    }

    public function getAllTasks(Request $request)
    {
        $allArr = Task::all();
        return $this->processData($allArr);
    }

    public function getAllTasksSupervisor(Request $request)
    {
        $allArr = Task::all();
        $respArr = [];

        foreach ($allArr as $data){
            $tmp = [];
            $tmp['title'] = '#'.$data['id'];
            $tmp['start'] = date('Y-m-d', strtotime($data['due_date'])).'T'.'00:00:00';
            $tmp['url'] = url('supervisor/tasks/info/'.$data['id']);
            $respArr[] = $tmp;
        }

        return $respArr;
    }

    public function getAllOrders(Request $request)
    {
        $allArr = CustomerOrder::all();
        return $this->processDataCustomerOrder($allArr);
    }


    protected function processData($allArr){
        $respArr = [];

        foreach ($allArr as $data){
            $tmp = [];
            $tmp['title'] = '#'.$data['id'];
            $tmp['start'] = date('Y-m-d', strtotime($data['due_date'])).'T'.'00:00:00';
            $tmp['url'] = url('admin/tasks/info/'.$data['id']);
            $respArr[] = $tmp;
        }

        return $respArr;
    }

    protected function processDataCustomerOrder($allArr){
        $respArr = [];

        foreach ($allArr as $data){
            $tmp = [];
            $tmp['title'] = '#'.$data['id'];
            $tmp['start'] = date('Y-m-d', strtotime($data['order_date'])).'T'.'00:00:00';
            $tmp['url'] = url('admin/customer-orders/info/'.$data['id']);
            $respArr[] = $tmp;
        }

        return $respArr;
    }

}
