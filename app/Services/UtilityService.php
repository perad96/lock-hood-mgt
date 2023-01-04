<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\JobRole;
use App\Models\MaterialBrand;
use App\Models\MaterialCategory;
use App\Models\Section;
use App\Models\Unit;

class UtilityService
{

    public function getAllRawMaterialCategories()
    {
        return MaterialCategory::orderBy('name')->get();
    }

    public function getAllRawMaterialBrands()
    {
        return MaterialBrand::orderBy('name')->get();
    }

    public function getAllUnits()
    {
        return Unit::orderBy('name')->get();
    }

    public function getAllUserRoles(): array
    {
        return ['ADMIN', 'SALES', 'FINANCE', 'HR', 'CUSTOMER'];
    }

    public function getAllGenders(): array
    {
        return ['MALE', 'FEMALE', 'OTHER'];
    }

    public function getAllOrderTypes(): array
    {
        return ['CUSTOM', 'EXISTING_PRODUCT'];
    }

    public function getAllStatus(): array
    {
        return ['PENDING', 'REJECT', 'DELIVERED', 'COMPLETE'];
    }

    public function getAllTaskStatus(): array
    {
        return ['PENDING', 'ONGOING', 'FAILED', 'HOLD', 'COMPLETED'];
    }

    public function getAllSectionsWithJobRoles()
    {
        return Section::with('jobRoles')->orderBy('name')->get();
    }

    public function getJobRolesBySectionId($id)
    {
        return JobRole::where('section_id', $id)->orderBy('name')->get();
    }

    public function getAllCustomers()
    {
        return Customer::all();
    }

}
