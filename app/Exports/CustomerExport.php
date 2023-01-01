<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromArray, WithHeadings
{
    protected $allArr;

    public function __construct($allArr)
    {
        $this->allArr = $allArr;
    }

    public function array(): array
    {
        $data = [];
        foreach ($this->allArr as $obj) {
            $data[] = [
                'company_name' => (isset($obj['company_name'])) ? $obj['company_name'] : '',
                'first_name' => (isset($obj['first_name'])) ? $obj['first_name'] : '',
                'last_name' => (isset($obj['last_name'])) ? $obj['last_name'] : '',
                'phone' => (isset($obj['phone'])) ? $obj['phone'] : '',
                'mobile' => (isset($obj['mobile'])) ? $obj['mobile'] : '',
                'email' => (isset($obj['email'])) ? $obj['email'] : ''
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Company Name', 'First Name', 'Last Name', 'Phone', 'Mobile', 'Email'
        ];
    }
}
