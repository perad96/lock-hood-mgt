<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MostIssuedTaskExport implements FromArray, WithHeadings
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
                'date' => (isset($obj['date'])) ? $obj['date'] : '',
                'task' => (isset($obj['task'])) ? $obj['task'] : '',
                'task_count' => (isset($obj['task_count'])) ? $obj['task_count'] : '',
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Task Title',
            'Allocated Tasks Count'
        ];
    }
}
