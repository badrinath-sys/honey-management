<?php
namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([

            'category_id' => $row['category_id'],

            'name'        => $row['name'],

            'price'       => $row['price'],

            'quantity'    => $row['quantity'],

            'weight'      => $row['weight'],

            'description' => $row['description'],

            'status'      => $row['status'],

        ]);
    }
}
