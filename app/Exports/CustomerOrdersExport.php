<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CustomerOrdersExport implements FromArray, WithHeadings, WithColumnFormatting
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
                'id' => (isset($obj['id'])) ? $obj['id'] : '',
                'customer' => $obj['customer']['first_name'].' '.$obj['customer']['last_name'],
                'order_amount' => (isset($obj['sub_total'])) ? $obj['sub_total'] : '',
                'discount_percentage' => (isset($obj['discount_percentage'])) ? $obj['discount_percentage'] : '',
                'order_date' => (isset($obj['order_date'])) ? $obj['order_date'] : '',
                'due_date' => (isset($obj['due_date'])) ? $obj['due_date'] : '',
                'delivered_date' => (isset($obj['delivered_date'])) ? $obj['delivered_date'] : '',
                'delivery_fee' => (isset($obj['delivery_fee'])) ? $obj['delivery_fee'] : '',
                'status' => (isset($obj['status'])) ? $obj['status'] : '',
            ];
        }
        return $data;
    }


    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer',
            'Order Amount',
            'Discount Percentage %',
            'Order Date',
            'Due Date',
            'Delivered Date',
            'Delivery Fee',
            'Status'
        ];
    }
}
