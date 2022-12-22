<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class RawMaterialsExport implements FromArray, WithHeadings, WithColumnFormatting
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
                'item_name' => (isset($obj['item_name'])) ? $obj['item_name'] : '',
                'category' => (isset($obj['category']['name'])) ? $obj['category']['name'] : '',
                'brand' => (isset($obj['brand']['name'])) ? $obj['brand']['name'] : '',
                'unit' => (isset($obj['unit']['name'])) ? $obj['unit']['name'] : '',
                'qty' => (isset($obj['qty'])) ? $obj['qty'] : '',
                'barcode' => (isset($obj['barcode'])) ? $obj['barcode'] : '',
                'description' => (isset($obj['description'])) ? $obj['description'] : '',
                'purchase_unit_price' => (isset($obj['purchase_unit_price'])) ? $obj['purchase_unit_price'] : '',
            ];
        }
        return $data;
    }


    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function headings(): array
    {
        return [
            'Item Name', 'Category', 'Brand', 'Unit', 'Qty', 'Barcode', 'Description', 'Purchased Unit Price'
        ];
    }
}
