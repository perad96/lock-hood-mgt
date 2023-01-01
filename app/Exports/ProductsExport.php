<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductsExport implements FromArray, WithHeadings, WithColumnFormatting
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
                'product_name' => (isset($obj['name'])) ? $obj['name'] : '',
                'unit_price' => (isset($obj['unit_price'])) ? $obj['unit_price'] : '',
                'qty' => (isset($obj['qty'])) ? $obj['qty'] : '',
                'barcode' => (isset($obj['barcode'])) ? $obj['barcode'] : '',
            ];
        }
        return $data;
    }


    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function headings(): array
    {
        return [
            'Product Name', 'Unit Price', 'Available Qty', 'Barcode'
        ];
    }
}
