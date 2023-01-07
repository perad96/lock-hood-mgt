<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TopSellingProductExport implements FromArray, WithHeadings
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
                'product' => (isset($obj['product'])) ? $obj['product'] : '',
                'qty' => (isset($obj['qty'])) ? $obj['qty'] : '',
            ];
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Product', 'Qty'
        ];
    }
}
