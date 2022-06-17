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
            $payments = Payment::criterion($criterio, $buscar)->with('customer')->with('membership')
                ->paginate(10); //add pagination
            $payments = Payment::criterion($criterio, $buscar)->join('customers', function ($j) use ($criterio, $buscar) {
                $j->on('customers.id', 'payments.customer_id');
                $j->when($criterio == 'customer', function ($q) use ($criterio, $buscar) {
                    $q->criterion($criterio, $buscar);
                });
            })
                ->join('memberships', function ($j) use ($criterio, $buscar) {
                    $j->on('memberships.id', 'payments.membership_id');
                    $j->when($criterio == 'membership', function ($q) use ($criterio, $buscar) {
                        $q->criterion($criterio, $buscar);
                    });
                })
                ->select(
                    'payments.id as id',
                    'customers.name as customer',
                    'memberships.name as membership',
                    'payments.paid_at as paid_at',
                    'payments.expires_at as expires_at',
                )
                ->paginate();
            // return $payments;


            /*  $paymentsRes = [];
            foreach ($payments as $pay) {
                array_push($paymentsRes, [
                    'id' => $pay->id,
                    'customer' => $pay->customer,
                    'paid at' => date($pay->paid_at),
                    // 'amount' => $pay->amount,
                    'membership' => $pay->membership->name,
                    'expires at' => date($pay->expires_at),
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
            // $branch = Branch::where('id', $user->branch_id)->first();
            // $company = Company::where('user_id', $user->id)->where('id', $branch->company_id)->first();
            // return $request;
            $membership =  Membership::where('id', $request->membership['id'])->first();
            $customer =  Customer::where('id', $request->customer['id'])->first();
            if (!$membership) return response('membership not found', 404);
            if (!$customer) return response('customer not found', 404);
            // return $membership;
            $data = [
                'paid_at' => $request->paid_at,
                'expires_at' => date('Y-m-d', strtotime($request->paid_at . "+ $membership->period days")),
                'amount' => $request->amount,
                'membership_id' => $membership->id,
                'customer_id' => $customer->id
            ];

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
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());
        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Payment::where('id', $id)->delete();
    }
}
