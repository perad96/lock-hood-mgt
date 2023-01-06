<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TasksExport implements FromArray, WithHeadings
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
                'task_count' => (isset($obj['task_count'])) ? $obj['task_count'] : '',
                'hours' => (isset($obj['hours'])) ? $obj['hours'] : '',
                'minutes' => (isset($obj['minutes'])) ? $obj['minutes'] : '',
                'pending_count' => (isset($obj['pending_count'])) ? $obj['pending_count'] : '',
                'completed_count' => (isset($obj['completed_count'])) ? $obj['completed_count'] : '',
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Task Created Date',
            'Task Count',
            'Spend Hours',
            'Spend Minutes',
            'Pending Task Count',
            'Completed Task Count'
        ];
    }
}
