<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use App\Http\Requests\StoreAssistanceRequest;
use App\Http\Requests\UpdateAssistanceRequest;
use App\Models\Branch;
use App\Models\Customer;
use Exception;
use Google\Service\AnalyticsData\OrderBy;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Assistance::with('customer')
            ->with('branch')
            ->get();
        return Assistance::all();
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
     * @param  \App\Http\Requests\StoreAssistanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $code = $request->code;
            $customer = Customer::where('code', $code)->firstOrFail();

            $customer = $customer->with(['membership' => function ($q) use ($customer) {
                $q->with(['payments' => function ($q1) use ($customer) {
                    $q1->where('customer_id', $customer->id)->orderBy('expires_at', 'desc');
                }]);
            }])->first();

            if (!$customer) return response('User not found', 404);

            $branch = Branch::where('id', $request->branch)->first(); //It be found by ip ? or aautenticatin manager
            if (!$branch) return 404;

            $data = [
                'customer_id' => $customer->id,
                'input' => date("Y-m-d H:i:s"),
                'branch_id' => $branch->id, // By location (Maybe ip)
            ];

            $resp = null;

            $assisted = Assistance::where('customer_id', $customer->id)
                ->where('branch_id', $branch->id)
                ->orderBy('input', 'desc')
                ->first();

            if ($assisted && $assisted['input'] != null && $assisted['output'] == null) {
                $assisted->output = date("Y-m-d H:i:s");
                $assisted->save();
                $resp =  ['salida' => $assisted, 'customer' => $customer];
            } else {
                $resp =  ['entrada' => Assistance::create($data), 'customer' => $customer];
            }
            return response()->json($resp, 200);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function show(Assistance $assistance)
    {
        return $assistance;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function edit(Assistance $assistance)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssistanceRequest  $request
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assistance $assistance)
    {
        $assistance->update($request->all());
        return $assistance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assistance  $assistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assistance $assistance)
    {
        $assistance->delete();
        return response()->json();
    }
}
