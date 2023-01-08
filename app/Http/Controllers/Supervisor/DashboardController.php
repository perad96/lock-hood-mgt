<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Traits\Messages;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use Messages;
    protected $resources = [];

    public function index()
    {
        try{
            $year = date('Y');
            $month = date('Y');

            $this->resources['monthOrdersTotalCount'] = CustomerOrder::whereMonth('order_date', $month)
                ->whereYear('order_date', $year)->count();

            $this->resources['monthOrdersCompleteCount'] = CustomerOrder::whereMonth('order_date', $month)
                ->whereYear('order_date', $year)->where('status', 'COMPLETE')->count();

            $this->resources['pendingOrdersCount'] = CustomerOrder::where('status', 'PENDING')->count();
            $this->resources['totalCustomersCount'] = Customer::count();

            return view('supervisor.dashboard')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }
}
