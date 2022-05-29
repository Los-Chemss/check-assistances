<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $buscar = $request->buscar;
            $criterio = $request->criterio;

            $user = Auth::user() ? Auth::user() : auth('sanctum')->user();
            // return $user;
            if (!$user) return response(null, 404);

            //
            $customers = Customer::criterion($criterio, $buscar)->with(['membership' => function ($query) {
                $query->with(['payments' => function ($q) {
                    $q->with('membership');
                    // $q->where('customer_id', 'customer.id')->orderBy('paid_at', 'desc')->first();
                }]);
            }])
                ->paginate(10); //add pagination
            $customersRes = [];
            foreach ($customers as $cus) {
                $payment = Payment::where('customer_id', $cus->id)->orderBy('paid_at', 'desc')->first();
                array_push($customersRes, [
                    'id' => $cus->id,
                    'name' => $cus->name,
                    'code' => $cus->code,
                    'income' => $cus->income,
                    'membership' => $cus->membership['name'],
                    'last paid' => $payment ? date($payment->paid_at) : '',
                    'expires at' => $payment ? date($payment->expires_at) : ''
                ]);
            }
            return [
                'pagination' => [
                    'total'        => $customers->total(),
                    'current_page' => $customers->currentPage(),
                    'per_page'     => $customers->perPage(),
                    'last_page'    => $customers->lastPage(),
                    'from'         => $customers->firstItem(),
                    'to'           => $customers->lastItem(),
                ],
                'customers' => $customersRes
            ];
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }
    public function select()
    {
        $customers = Customer::where('company_id', 2)->with(['membership' => function ($query) {
            $query->with(['payments' => function ($q) {
                $q->with('membership');
                // $q->where('customer_id', 'customer.id')->orderBy('paid_at', 'desc')->first();
            }]);
        }])->get();
        return $customers;
    }

    public function view()
    {
        $user = Auth::user();
        return view('customers.index', compact('user'));
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
    public function store(Request $request)
    {
        $user = Auth::user();
        $branch = Branch::where('id', $user->branch_id)->first();
        $company = Company::where('user_id', $user->id)->where('id', $branch->company_id)->first();
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'income' => $request->income,
            'company_id' => $company->id
        ];
        return Customer::create($data);
        try {
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
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
    public function destroy($id)
    {
        return Customer::where('id', $id)->delete();
        // return $customer;

        // $customer->delete();
        // return response()->json();
    }
}
