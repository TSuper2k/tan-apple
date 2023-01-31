<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerAddRequest;
use App\Http\Requests\CustomerLoginRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientCheckoutController extends Controller
{

	public function loginCheckout()
	{
		$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
		return view('client.login.login', compact('categoriesLimit'));
	}

	public function addCustomer(CustomerAddRequest $request)
	{
		$data = array();
		$data['name'] = $request->name;
		$data['email'] = $request->email;
		$data['phone'] = $request->phone;
		$data['address'] = $request->address;
		$data['password'] = md5($request->password);

		$customer_id = Customer::insertGetId($data);

		$request->session()->put('id', $customer_id);
		$request->session()->put('name', $request->name);

		return redirect('/checkout');
	}

	public function checkout()
	{

		$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
		$productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
		return view('client.login.checkout', compact('categoriesLimit', 'productsRecommend'));
	}

	// public function saveCheckout(Request $request)
	// {
	//     $data = array();
	//     $data['customer_name'] = $request->customer_name;
	//     $data['customer_email'] = $request->customer_email;
	//     $data['customer_phone'] = $request->customer_phone;
	//     $data['customer_address'] = $request->customer_address;
	//     $data['customer_note'] = $request->customer_note;

	//     $shipping_id = Shipping::insertGetId($data);

	//     $request->session()->put('id', $shipping_id);

	//     return redirect('/payment');
	// }

	public function payment()
	{
		$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
		return view('client.login.payment', compact('categoriesLimit'));
	}

	public function order(Request $request)
	{
		$total = 0;
		foreach (session('cart') as $id => $details) {
			$subtotal = $details['price'] * $details['quantity'];
			$product_id = $id;
			$total += $subtotal;
		}

		//insert payment method
		$data = array();
		$data['payment_method'] = $request->payment_option;
		$data['payment_status'] = 'Đang chờ xử lí';

		$data['created_at'] = new \DateTime();

		$payment_id = Payment::insertGetId($data);

		//insert order
		$order_data = array();
		$order_data['customer_id'] = $request->session()->get('id');
		// $order_data['shipping_id'] = $request->session()->get('id');
		$order_data['payment_id'] = $payment_id;
		$order_data['order_total'] = $total;
		$order_data['order_status'] = '1';
		$order_data['order_date'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

		$order_data['created_at'] = new \DateTime();

		$order_id = Order::insertGetId($order_data);

		//insert order_details
		foreach (session('cart') as $id => $details) {
			// $order_detail_data = array();
			$order_detail_data['order_id'] = $order_id;
			$order_detail_data['product_id'] = $id;
			$order_detail_data['payment_id'] = $payment_id;
			$order_detail_data['customer_id'] = $request->session()->get('id');
			$order_detail_data['product_name'] = $details['name'];
			$order_detail_data['product_price'] = $details['price'];
			$order_detail_data['product_quantity'] = $details['quantity'];
			$order_detail_data['order_status'] = '1';

			$order_detail_data['created_at'] = new \DateTime();

			DB::table('order_details')->insert($order_detail_data);
		}


		if ($data['payment_method'] == 1) {
			$this->sendMail();
			$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
			return view('client.login.order_success', compact('categoriesLimit'));
		} elseif ($data['payment_method'] == 2) {
			$this->sendMail();
			$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
			return view('client.login.order_success', compact('categoriesLimit'));
		} else {
			$this->sendMail();
			$categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
			return view('client.login.order_success', compact('categoriesLimit'));
		}
	}

	//mail
	private function sendMail()
	{
		$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

		$title_mail = "Đơn hàng xác nhận vào lúc: " . '' . $now;
		$customer = Customer::find(session()->get('id'));

		$data['email'][] = $customer->email;

		if (session('cart') == true) {
			foreach (session('cart') as $id => $cart_mail) {
				$cart_array[] = array(
					// 'product_id' => $id,
					'product_name' => $cart_mail['name'],
					'product_price' => $cart_mail['price'],
					'product_quantity' => $cart_mail['quantity']
				);
			}
		}

		$customer_array = array(
			'customer_name' => $customer->name,
			'customer_email' => $customer->email,
			'customer_phone' => $customer->phone,
			'customer_address' => $customer->address,
		);

		Mail::send(
			'client.mail.mail_order',
			['cart_array' => $cart_array, 'customer_array' => $customer_array],
			function ($message) use ($title_mail, $data) {
				$message->to($data['email'])->subject($title_mail);
				$message->from('hello@example.com', $title_mail);
			}
		);
		session()->forget('cart');
		session()->forget('success_paypal');
		session()->forget('total_paypal');
	}

	public function logoutCheckout(Request $request)
	{
		$request->session()->flush();
		return redirect('/login-checkout');
	}

	public function loginCustomer(CustomerLoginRequest $request)
	{
		$email = $request->email_account;
		$password = md5($request->password_account);
		$result = Customer::where('email', $email)->where('password', $password)->first();

		if ($result) {
			$request->session()->put('id', $result->id);
			return redirect('/checkout');
		} else {
			return redirect('/login-checkout');
		}
	}
}
