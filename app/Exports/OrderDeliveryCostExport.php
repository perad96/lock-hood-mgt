<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrderDeliveryCostExport implements FromArray, WithHeadings, WithColumnFormatting
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
                'order_count' => (isset($obj['order_count'])) ? $obj['order_count'] : '',
                'delivery_fee_sum' => (isset($obj['delivery_fee_sum'])) ? $obj['delivery_fee_sum'] : '',
            ];
        }
        return $data;
    }


    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00
        ];
    }

    public function headings(): array
    {
        return [
            'Date', 'Order Count', 'Delivery Fee Cost'
        ];
    }
}
