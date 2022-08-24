<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
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

            $payments = Payment::when(
                ($criterio == 'paid_at' || $criterio == 'expires_at') && $buscar,
                function ($q) use ($criterio, $buscar) {
                    if ($criterio == 'paid_at') {
                        $q->where('paid_at', 'like', "%$buscar%");
                    }
                    if ($criterio == 'expires_at') {
                        $q->Where('expires_at', 'like', "%$buscar%");
                    }
                }
            )->join('branches', function ($j) use ($criterio, $buscar) {
                $j->on('branches.id', 'payments.registered_on_branch_id');
                if ($criterio === 'branch') {
                    $j->where('branches.division', 'LIKE', "%$buscar%")
                        ->orWhere('branches.location', 'LIKE', "%$buscar%");
                }
                $j->latest('branches.id');
            })->join('customers', function ($j) use ($criterio, $buscar) {
                $j->on('customers.id', 'payments.customer_id');
                if ($criterio === 'customer') {
                    $j->where('name', 'like', "%$buscar%")->orWhere('code', 'like', "%$buscar%");
                }
            })
                ->join('memberships', function ($j) use ($criterio, $buscar) {
                    $j->on('memberships.id', 'payments.membership_id');
                    if ($criterio == 'membership' && $buscar) {
                        $j->where('memberships.name', 'like', "%$buscar%");
                    }
                })
                ->select(
                    'payments.id as id',
                    DB::raw("CONCAT(customers.name,' ',customers.lastname) as customer"),
                    'memberships.name as membership',
                    'payments.paid_at as paid_at',
                    'payments.expires_at as expires_at',
                    'branches.division as branch',
                    // 'customers.name as customer',
                    // 'customers.id as customerId',

                    // 'memberships.id as membershipId',
                )
                ->orderBy('payments.paid_at', 'desc')
                ->paginate();

            // return $payments;

            /* $paymentsRes = [];
            foreach ($payments as $pay) {
                array_push($paymentsRes, [
                    'id' => $pay->id,
                    'customer' => $pay->customer,
                    'paid at' => date($pay->paid_at),
                    // 'amount' => $pay->amount,
                    'membership' => $pay->membership,
                    'expires at' => date($pay->expires_at),
                    'branch' => $pay->branch,
                ]);
            } */
            return [
                'pagination' => [
                    'total'        => $payments->total(),
                    'current_page' => $payments->currentPage(),
                    'per_page'     => $payments->perPage(),
                    'last_page'    => $payments->lastPage(),
                    'from'         => $payments->firstItem(),
                    'to'           => $payments->lastItem(),
                ],
                'payments' => $payments
            ];
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }

    public function customerPayments(Request $request, $customer)
    {
        try {
            $buscar = $request->buscar;
            $criterio = $request->criterio;

            $user = Auth::user() ? Auth::user() : auth('sanctum')->user();
            if (!$user) return response(null, 404);

            $payments = Payment::where('customer_id', $customer)->when(
                ($criterio == 'paid_at' || $criterio == 'expires_at') && $buscar,
                function ($q) use ($criterio, $buscar) {
                    if ($criterio == 'paid_at') {
                        $q->where('paid_at', 'like', "%$buscar%");
                    }
                    if ($criterio == 'expires_at') {
                        $q->Where('expires_at', 'like', "%$buscar%");
                    }
                }
            )->join('branches', function ($j) use ($criterio, $buscar) {
                $j->on('branches.id', 'payments.registered_on_branch_id');
                if ($criterio === 'branch') {
                    $j->where('branches.division', 'LIKE', "%$buscar%")
                        ->orWhere('branches.location', 'LIKE', "%$buscar%");
                }
                $j->latest('branches.id');
            })->join('customers', function ($j) use ($criterio, $buscar) {
                $j->on('customers.id', 'payments.customer_id');
                if ($criterio === 'customer') {
                    $j->where('name', 'like', "%$buscar%")->orWhere('code', 'like', "%$buscar%");
                }
            })
                ->join('memberships', function ($j) use ($criterio, $buscar) {
                    $j->on('memberships.id', 'payments.membership_id');
                    if ($criterio == 'membership' && $buscar) {
                        $j->where('memberships.name', 'like', "%$buscar%");
                    }
                })
                ->orderBy('payments.paid_at', 'desc')
                ->select(
                    'payments.id as id',
                    'customers.name as customer',
                    'customers.id as customerId',
                    'memberships.name as membership',
                    'payments.amount',
                    'memberships.id as membershipId',
                    'payments.paid_at as paid_at',
                    'payments.expires_at as expires_at',
                    'branches.division as branch',
                )
                ->paginate();

            // return $payments;

            /*    $paymentsRes = [];
            foreach ($payments as $pay) {
                array_push($paymentsRes, [
                    'id' => $pay->id,
                    'customer' => $pay->customer,
                    'paid at' => date($pay->paid_at),
                    // 'amount' => $pay->amount,
                    'membership' => $pay->membership,
                    'expires at' => date($pay->expires_at),
                    'branch' => $pay->branch,
                ]);
            } */
            return [
                'pagination' => [
                    'total'        => $payments->total(),
                    'current_page' => $payments->currentPage(),
                    'per_page'     => $payments->perPage(),
                    'last_page'    => $payments->lastPage(),
                    'from'         => $payments->firstItem(),
                    'to'           => $payments->lastItem(),
                ],
                'payments' => $payments
            ];
        } catch (Exception $e) {
            return response($e->getMessage());
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
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $branch = Branch::where('id', $user->branch_id)->first();
            if (!isset($branch->id)) {
                return response('No branch', 404);
            }
            $membership =  Membership::where('id', $request->membership)->first();
            if (!isset($membership->id)) {
                return response('membership not found', 404);
            }
            $customer =  Customer::where('id', $request->customer)->first();
            if (!isset($customer->id)) {
                return response('customer not found', 404);
            }

            $customer->membership_id = $membership->id;
            $data = [
                'paid_at' => $request->paid_at,
                'expires_at' => date('Y-m-d', strtotime($request->paid_at . "+ $membership->period days")),
                'amount' => $membership->price,
                'membership_id' => $membership->id,
                'customer_id' => $customer->id,
                'registered_on_branch_id' => $branch->id
            ];
            $customer->save();
            $payment = Payment::create($data);
            return response()->json(['membership' => $membership, 'payment' => $payment]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, $id)
    {
        try {
            $user = Auth::user();
            $payment = Payment::where('id', $id)->first();
            if (!isset($payment->id)) {
                return response("Payment Not found", 404);
            }
            $membership = Membership::Where('id', $payment->membership_id)->first();
            if (isset($request->membership)) {
                $membership = Membership::where('id', $request->membership)->first();
                $payment->membership_id = $request->membership;
            }
            if (!isset($membership->id)) {
                return response("Membership Not found", 404);
            }
            if (isset($request->payd_at)) {
                $payment->payd_at = $request->payd_at;
            }
            if (isset($request->membership) || isset($request->payd_at)) {
                $payment->expires_at = date('Y-m-d', strtotime($request->paid_at . "+ $membership->period days"));
                $payment->amount = $membership->price;
                $payment->registered_on_branch_id = $user->branch_id;
            }
            if (isset($request->customer)) {
                $payment->customer_id = $request->customer;
                $customer =  Customer::where('id', $request->customer)->first();
                $customer->membership_id = $membership->id;
                $customer->save();
            }
            $payment->save();
            return response('updated', 200);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // return $id;
            $payment = Payment::where('id', $id)->first();
            if (!isset($payment->id)) {
                return response('Not found', 404);
            }
            $payment->delete();
            return  response('Deleted', 200);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }
}
