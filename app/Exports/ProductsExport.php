<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    public function collection()
    {
        return Product::select(
            'id',
            'name',
            'price',
            'quantity',
            'weight',
            'status'
        )->get();
    }
}
