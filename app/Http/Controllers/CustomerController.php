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
            if (!$user) return response(null, 404);

            $customers = Customer::when(
                $criterio,
                function ($q) use ($criterio, $buscar) {
                    if ($criterio === 'name' || $criterio === 'lastname' || $criterio === 'code') {
                        $q->criterion($criterio, $buscar);
                    }
                }
            )
                ->Join(
                    'branches',
                    function ($j) use ($criterio, $buscar) {
                        $j->on('branches.id', 'customers.registered_on_branch_id');
                        if ($criterio === 'branch') {
                            $j->where('branches.division', 'LIKE', "%$buscar%")
                                ->orWhere('branches.location', 'LIKE', "%$buscar%");
                        }
                    }
                )
                ->select(
                    'customers.membership_id',
                    'customers.id as id',
                    'customers.name',
                    'customers.lastname',
                    'customers.code',
                    'customers.income',
                    'customers.address',
                    'customers.province',
                    'customers.postcode',
                    'customers.phone',
                    'branches.division',
                )
                ->orderBy('id', 'asc')
                ->paginate(10); //add pagination

            // return $customers;
            $customersRes = [];
            foreach ($customers as $cus) {
                // $payment = Payment::where('customer_id', $cus->id)->orderBy('paid_at', 'desc')->first();
                array_push($customersRes, [
                    'id' => $cus->id,
                    'name' => $cus->name,
                    'lastname' => $cus->lastname,
                    'address' => $cus->address,
                    'province' => $cus->province,
                    'postcode' => $cus->postcode,
                    'phone' => $cus->phone,


                    'code' => $cus->code,
                    'branch' => $cus->division ?: null,
                    'income' => $cus->income,
                    'membership' => $cus->membership['name'],
                    'last paid' => $cus->latestPayment ? date($cus->latestPayment->paid_at) : '',
                    'expires at' => $cus->latestPayment ? date($cus->latestPayment->expires_at) : ''
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
        $customers = Customer::where('company_id', 1)
            ->with(['membership' => function ($query) {
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
        try {
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
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
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
        try {
            $user = Auth::user();
            $branch = Branch::where('id', $user->branch_id)->first();
            if (!$branch) return response('No branch', 404);
            $company = Company::where('user_id', $user->id)->where('id', $branch->company_id)->first();
            $membership =  Membership::where('id', $request->membership)->first();
            if (!$membership) return response('Membership not found', 404);

            $data = [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'code' => $request->code,
                'income' => $request->income,
                'company_id' => $company->id,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'province' => $request->province,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'registered_on_branch_id' => $branch->id
            ];

            $customer = Customer::create($data);
            $paid = [
                'paid_at' => $request->income,
                'expires_at' => date('Y-m-d', strtotime($request->paid_at . "+ $membership->period days")),
                'membership_id' => $membership->id,
                'customer_id' => $customer->id
            ];
            $payment = Payment::create($paid);
            return response(201);
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
        try {
            $return = Customer::where('id', $customer->id)
                ->with('membership')
                ->with('payments', function ($q) {
                    $q->with('membership');
                })
                ->with('asistances', function ($q) {
                    $q->with('branch');
                })
                ->first();
            return response()->json($return);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__);
        }
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
        try {
            $customer = Customer::where('id', $request->id)->first();
            if (isset($request)) {
                foreach ($request->all() as $key => $val) {
                    if ($customer->$key) {
                        $customer->$key = $val;
                    }
                }
                $customer->save();
                return response()->json(200);
            }
            return response('Updated', 200);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::where('id', $id)->first();
            if (!$customer) return response('Customer not found', 404);
            $customer->delete();
            return response('Cliente eliminado', 200);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }
}
