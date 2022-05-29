<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Branch;
use App\Models\Company;
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
            // return $payments;
            $paymentsRes = [];
            foreach ($payments as $cus) {
                array_push($paymentsRes, [
                    'id' => $cus->id,
                    'customer' => $cus->customer->name,
                    'paid at' => date($cus->paid_at),
                    'amount' => $cus->amount,
                    'membership' => $cus->membership->name,
                    'expires at' => date($cus->expires_at),
                ]);
            }
            return [
                'pagination' => [
                    'total'        => $payments->total(),
                    'current_page' => $payments->currentPage(),
                    'per_page'     => $payments->perPage(),
                    'last_page'    => $payments->lastPage(),
                    'from'         => $payments->firstItem(),
                    'to'           => $payments->lastItem(),
                ],
                'payments' => $paymentsRes
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
            $data = [
                'paid_at' => $request->paid_at,
                'expires_at' => $request->expires_at,
                'amount' => $request->amount,
                'membership_id' => $request->membership->id,
                'customer_id' => $request->customer->id
            ];
            return Payment::create($data);
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
