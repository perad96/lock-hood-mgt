<?php

namespace App\Services;

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
        return ['ADMIN','SALES','FINANCE','HR','CUSTOMER'];
    }

    public function getAllSectionsWithJobRoles()
    {
        return Section::with('jobRoles')->orderBy('name')->get();
    }

}
