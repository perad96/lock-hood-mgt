<?php

namespace App\Http\Controllers\Admin;

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
            $month = date('Y');
            $this->resources['monthOrdersTotalCount'] = CustomerOrder::whereMonth('order_date', $month)->count();
            $this->resources['monthOrdersCompleteCount'] = CustomerOrder::whereMonth('order_date', $month)->where('status', 'COMPLETE')->count();
            $this->resources['pendingOrdersCount'] = CustomerOrder::where('status', 'PENDING')->count();
            $this->resources['totalCustomersCount'] = Customer::count();

            return view('admin.dashboard')->with($this->resources);
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->back()->with($this->resources);
        }
    }
}
