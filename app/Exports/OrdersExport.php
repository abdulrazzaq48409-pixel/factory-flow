<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::select(
            'id',
            'customer_name',
            'product_name',
            'quantity',
            'price',
            'order_date'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer',
            'Product',
            'Quantity',
            'Price',
            'Order Date'
        ];
    }
}