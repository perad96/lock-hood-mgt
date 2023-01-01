<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromArray, WithHeadings
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
                'first_name' => (isset($obj['first_name'])) ? $obj['first_name'] : '',
                'last_name' => (isset($obj['last_name'])) ? $obj['last_name'] : '',
                'date_of_birth' => (isset($obj['date_of_birth'])) ? $obj['date_of_birth'] : '',
                'email' => (isset($obj['email'])) ? $obj['email'] : '',
                'phone' => (isset($obj['phone'])) ? $obj['phone'] : '',
                'gender' => (isset($obj['gender'])) ? $obj['gender'] : '',
                'section' => (isset($obj['section']['name'])) ? $obj['section']['name'] : '',
                'job_role' => (isset($obj['jobRole']['name'])) ? $obj['jobRole']['name'] : '',
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'First Name', 'Last Name', 'Date of Birth', 'Email', 'Phone', 'Gender', 'Section', 'Job Role'
        ];
    }
}
