<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
	private $order;

	public function __construct(
		Order $order
	) {
		$this->order = $order;
	}

	public function orderStatus()
	{
		$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
		$productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
		$allOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
			->select('orders.*', 'customers.name')->orderBy('orders.id', 'desc')->get();

		// $allOrder = DB::table('orders')
		//     ->join('customers', 'orders.customer_id', '=', 'customers.id')
		//     ->select('orders.*', 'customers.name')->orderBy('orders.id', 'desc')->get();

		// $manage_order = view('admin.order.index', compact('allOrder'));

		return view('client.order.index', compact('allOrder', 'categoriesLimit', 'productsRecommend'));
	}

	public function orderStatusDetail($id)
	{
		$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
		$productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
		$orderById = DB::table('order_details')
			->join('customers', 'order_details.customer_id', '=', 'customers.id')
			->join('payments', 'order_details.payment_id', '=', 'payments.id')
			->join('orders', 'order_details.order_id', '=', 'orders.id')
			->join('products', 'order_details.product_id', '=', 'products.id')
			->select('orders.*', 'customers.*', 'order_details.*', 'payments.*', 'products.*')
			->where('orders.id', $id)
			->get();
			// dd($orderById);
			
			$customer_id = session()->get('id');
			$nameCustomer = Customer::select('customers.*')->where('id', '=', $customer_id)->get();
			// dd($nameCustomer);

		return view('client.order.detail', compact('orderById', 'categoriesLimit', 'productsRecommend', 'nameCustomer'));
	}
}
