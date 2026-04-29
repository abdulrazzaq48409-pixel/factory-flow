<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    private function checkOrdersAccess()
    {
        if (!session('admin_logged_in')) {
            return redirect('/login');
        }

        if (session('staff_role') == 'Warehouse') {
            return redirect('/products');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        $orders = Order::latest()->get();

        $totalOrders  = $orders->count();
        $totalRevenue = $orders->sum('price');
        $totalQty     = $orders->sum('quantity');

        $totalProfit = 0;

        foreach ($orders as $order) {
            $product = Product::where('product_name', $order->product_name)->first();

            if ($product) {
                $profitPerUnit = $order->price - $product->buy_price;
                $totalProfit += ($profitPerUnit * $order->quantity);
            }
        }

        return view('orders.index', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'totalQty',
            'totalProfit'
        ));
    }

    public function create()
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        return view('orders.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        Order::create([
            'customer_name' => $request->customer_name,
            'product_name'  => $request->product_name,
            'quantity'      => $request->quantity,
            'price'         => $request->price,
            'order_date'    => $request->order_date,
            'status'        => $request->status ?? 'Pending',
        ]);

        $product = Product::where('product_name', $request->product_name)->first();

        if ($product) {
            $product->stock = $product->stock - $request->quantity;
            $product->save();
        }

        return redirect('/orders')->with('success', 'Order Added + Stock Updated');
    }

    public function edit($id)
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        $order = Order::findOrFail($id);

        $order->update([
            'customer_name' => $request->customer_name,
            'product_name'  => $request->product_name,
            'quantity'      => $request->quantity,
            'price'         => $request->price,
            'order_date'    => $request->order_date,
            'status'        => $request->status,
        ]);

        return redirect('/orders')->with('success', 'Order Updated');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        Order::findOrFail($id)->delete();

        return redirect('/orders')->with('success', 'Order Deleted');
    }

    public function export()
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function invoice($id)
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        $order = Order::findOrFail($id);

        $pdf = Pdf::loadView('orders.invoice', compact('order'));

        return $pdf->download('invoice_'.$order->id.'.pdf');
    }

    public function whatsapp($id)
    {
        if ($redirect = $this->checkOrdersAccess()) return $redirect;

        $order = Order::findOrFail($id);

        $message = "Hello ".$order->customer_name.
                   ", your order for ".$order->product_name.
                   " (Qty: ".$order->quantity.") is ready. ".
                   "Status: ".$order->status.
                   ". Thank you from FactoryFlow.";

        return redirect("https://wa.me/?text=".urlencode($message));
    }
}