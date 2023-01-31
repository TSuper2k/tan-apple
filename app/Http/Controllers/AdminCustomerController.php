<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerAddRequest;
use App\Http\Requests\CustomerEditRequest;
use App\Models\Customer;
use App\Traits\DeleteModelTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminCustomerController extends Controller
{
    use DeleteModelTrait;
    private $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function index()
    {
        $customers = $this->customer->paginate(10);
        return view('admin.customer.index', compact('customers'));
    }

    // public function create()
    // {
    //     return view('admin.customer.add');
    // }

    // public function store(CustomerAddRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $customer = $this->customer->create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'address' => $request->address,
    //             'password' => Hash::make($request->password)
    //         ]);
    //         DB::commit();
    //         return redirect()->route('customers.index');
    //     } catch (Exception $exception) {
    //         DB::rollBack();
    //         Log::error('Message: ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
    //     }
    // }

    // public function edit($id)
    // {
    //     $customer = $this->customer->find($id);
    //     return view('admin.customer.edit', compact('customer'));
    // }

    // public function update(CustomerEditRequest $request, $id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $this->customer->find($id)->update([
    //             'name' => $request->name,
    //             'email' => $request->email
    //         ]);
    //         $customer = $this->customer->find($id);
    //         $customer->roles()->sync($request->role_id);
    //         DB::commit();
    //         return redirect()->route('customers.index');
    //     } catch (Exception $exception) {
    //         DB::rollBack();
    //         Log::error('Message: ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
    //     }
    // }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->customer);
    }
}
