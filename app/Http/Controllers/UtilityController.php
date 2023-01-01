<?php

namespace App\Http\Controllers;

use App\Services\UtilityService;
use App\Traits\Messages;
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

}
