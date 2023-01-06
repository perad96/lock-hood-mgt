<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class IncomeExport implements FromArray, WithHeadings, WithColumnFormatting
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
                'order_date' => (isset($obj['order_date'])) ? $obj['order_date'] : '',
                'sub_total_sum' => (isset($obj['sub_total_sum'])) ? $obj['sub_total_sum'] : '',
                'custom_order_count' => (isset($obj['custom_order_count'])) ? $obj['custom_order_count'] : '',
                'product_order_count' => (isset($obj['product_order_count'])) ? $obj['product_order_count'] : '',
                'order_count' => (isset($obj['order_count'])) ? $obj['order_count'] : '',
                'delivery_fee_sum' => (isset($obj['delivery_fee_sum'])) ? $obj['delivery_fee_sum'] : '',
            ];
        }
        return $data;
    }


    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function headings(): array
    {
        return [
            'Order Date', 'Income', 'Custom Orders Count', 'Product Orders Count', 'Total Orders Count', 'Delivery Cost'
        ];
    }
}
