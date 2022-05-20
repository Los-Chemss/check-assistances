<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('customers.index');
        $customers =  Customer::with(['company' => function ($query) {
            $query->with(['memberships' => function ($q) {
                $q->with(['payments' => function ($q) {
                    $q->where('payments.customer_id', 1);
                }]);
            }]);
        }])->get();

        /*   ->with(['memberships' => function ($query) {
                $query->with('payments');
            }])->get();
        */

        return $customers;

        foreach ($customers as $cus) {
            foreach ($cus->memberships as $mem) {
                foreach ($mem->payments as $key => $pay) {
                    if ($pay->customer_id != $cus->id) {
                        unset($mem->payments[$key]);
                    }
                }
            }
        }
        return $customers;
    }



    public function getCustomersOfBranch()
    {

        //los users pertenecen ala compoany (<o>)
        $user = User::where('id', 1)->firstOrFail();
        // $user = User::where('id', Auth::user()->id)->firstOrFail();

        // return $user;

        return Company::with(['branches' => function ($q) use ($user) {
            $q->where('branches.id', $user->branch_id);
        }])->get();
        // return Customer::all();


        /*
        select (*) from customers join company where id in branch.company_id
        */

        $customers = Customer::with(['company', function ($q) {
            $q->with('branches');
        }])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        return Customer::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json();
    }
}
