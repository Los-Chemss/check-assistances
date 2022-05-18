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
            $customer = Customer::where('code', $code)->first();
            $branch = Branch::where('id', 2)->first(); //It be found by ip ? or aautenticatin manager


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

                $resp =  ['Out at' => $assisted];
            } else {
                $resp =  ['In at at' => Assistance::create($data)];
            }

            return response()->json($resp);
            return 200;

            Assistance::create($request->all());
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
