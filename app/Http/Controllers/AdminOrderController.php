<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Statistical;
use App\Traits\DeleteModelTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
	use DeleteModelTrait;
	private $order;

	public function __construct(
		Order $order
	) {
		$this->order = $order;
	}

	public function index()
	{
		$allOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
			->select('orders.*', 'customers.name')->orderBy('orders.id', 'desc')->latest()->paginate(5);

		// $allOrder = DB::table('orders')
		//     ->join('customers', 'orders.customer_id', '=', 'customers.id')
		//     ->select('orders.*', 'customers.name')->orderBy('orders.id', 'desc')->get();

		// $manage_order = view('admin.order.index', compact('allOrder'));

		return view('admin.order.index', compact('allOrder'));
	}

	public function view($id)
	{
		$orderById = OrderDetail::with('product')
			->join('customers', 'order_details.customer_id', '=', 'customers.id')
			->join('payments', 'order_details.payment_id', '=', 'payments.id')
			->join('orders', 'order_details.order_id', '=', 'orders.id')
			->join('products', 'order_details.product_id', '=', 'products.id')
			->select('orders.*', 'customers.*', 'order_details.*', 'payments.*', 'products.*')
			->where('orders.id', $id)
			->get();

		// dd($orderById);
		$orders = Order::where('id', $id)->get();
		// dd($orders);

		$customers = DB::table('orders')
			->join('customers', 'orders.customer_id', '=', 'customers.id')
			->select('customers.*', 'orders.*')
			->where('orders.id', $id)
			->get();
		// dd($customers);

		// $manage_order_by_id = view('admin.order.view')->with('orderById', $orderById);
		return view('admin.order.view', compact('orderById', 'orders', 'customers'));
	}

	public function delete($id)
	{
		return $this->deleteModelTrait($id, $this->order);
	}

	public function updateOrderQty(Request $request){
		//update order
		$data = $request->all();
		
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();

		//order date
		$order_date = $order->order_date;
		$statistic = Statistical::where('order_date', $order_date)->get();
		if($statistic){
			$statistic_count = $statistic->count();
		} else{
			$statistic_count = 0;
		}

		if($order->order_status == 2){
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_quantity = $product->quantity;
				$product_sold = $product->sold;
				foreach($data['product_quantity'] as $key2 => $qty){
					if($key == $key2){
						$product_remain = $product_quantity - $qty;
						$product->quantity = $product_remain;
						$product->sold = $product_sold + $qty;
						$product->save();
					}
				}
			}
		} 
		elseif($order->order_status == 1){
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_quantity = $product->quantity;
				$product_sold = $product->sold;
				foreach($data['product_quantity'] as $key2 => $qty){
					if($key == $key2){
						$product_remain = $product_quantity + $qty;
						$product->quantity = $product_remain;
						$product->sold = $product_sold - $qty;
						$product->save();
					}
				}
			}
		} 
		elseif($order->order_status == 3){
			$total_order = 0;
			$sales = 0;
			$quantity = 0;
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_quantity = $product->quantity;
				$product_sold = $product->sold;
				$product_price = $product->price;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
				foreach($data['product_quantity'] as $key2 => $qty){
					if($key == $key2){
						// $product_remain = $product_quantity - $qty;
						// $product->quantity = $product_remain;
						// $product->sold = $product_sold + $qty;
						// $product->save();
						$quantity += $qty;
						$total_order += 1;
						$sales += $product_price * $qty;
					}
				}
			}
			if($statistic_count > 0){
				$statistic_update = Statistical::where('order_date', $order_date)->first();
				$statistic_update->sales = $statistic_update->sales + $sales;
				$statistic_update->quantity = $statistic_update->quantity + $quantity;
				$statistic_update->total_order = $statistic_update->total_order + $total_order;
				$statistic_update->save();
			} else{
				$statistic_new = new Statistical();
				$statistic_new->order_date = $order->order_date;
				$statistic_new->sales = $sales;
				$statistic_new->quantity = $quantity;
				$statistic_new->total_order = $total_order;
				$statistic_new->save();
			}
		} elseif($order->order_status == 4){
			foreach($data['order_product_id'] as $key => $product_id){
				$product = Product::find($product_id);
				$product_quantity = $product->quantity;
				$product_sold = $product->sold;
				foreach($data['product_quantity'] as $key2 => $qty){
					if($key == $key2){
						$product_remain = $product_quantity + $qty;
						$product->quantity = $product_remain;
						$product->sold = $product_sold - $qty;
						$product->save();
					}
				}
			}
		}
	}

	public function updateQty(Request $request){
		$data = $request->all();
		$order_details = OrderDetail::where('product_id', $data['order_product_id'])
		->where('order_id', $data['order_id'])
		->first();

		$order_details->product_quantity = $data['order_qty'];
		$order_details->save();
	}
}
