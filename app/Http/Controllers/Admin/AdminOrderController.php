<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user:id,name,email')
            ->withCount('transactions')
            ->orderBy('id', 'desc')
            ->paginate(20);

        $viewData = [
            'orders' => $orders
        ];

        return view('admin.pages.order.index', $viewData);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $orderModel = new Order();
        $status = $orderModel->statusConfig;
        $statusShippingConfig = $orderModel->statusShippingConfig;

        return view('admin.pages.order.update', compact('order','status','statusShippingConfig'));
    }

    public function update(Request $request, $id)
    {
        $order                   = Order::find($id);
        $order->note             = $request->note;
        $order->status             = $request->status;
        $order->shipping_status             = $request->shipping_status;
        $order->receiver_address = $request->address;
        $order->updated_at       = Carbon::now();
        $order->save();
        return redirect()->route('get_admin.order.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                Transaction::where('order_id', $id)->delete();
                $order->delete();
            }

//            toastr()->success("Xử lý dữ liệu thành công", "Thông báo!");
        } catch (\Exception $exception) {
//            toastr()->error("Xử lý dữ liệu thất bại", "Thông báo!");
        }
        return redirect()->back();
    }
}
