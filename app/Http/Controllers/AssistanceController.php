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
    public function index(Request $request)
    {
        try {
            $buscar = $request->buscar;
            $criterio = $request->criterio;

            $asistances = Assistance::with('customer')
                ->with('branch')
                ->when($buscar && $criterio, function ($q) use ($criterio, $buscar) {
                    $q->criterion($criterio, $buscar);
                })
                // ->criterion($criterio, $buscar)
                ->paginate(10);
            $asistancesRes = [];
            foreach ($asistances as $as) {
                array_push($asistancesRes, [
                    'id' => $as->id,
                    'nombre' => $as->customer->name,
                    'entrada' => $as->input,
                    // 'salida' => $as->output,
                    'sucursal' => $as->branch->division,
                ]);
            }

            return [
                'pagination' => [
                    'total'        => $asistances->total(),
                    'current_page' => $asistances->currentPage(),
                    'per_page'     => $asistances->perPage(),
                    'last_page'    => $asistances->lastPage(),
                    'from'         => $asistances->firstItem(),
                    'to'           => $asistances->lastItem(),
                ],
                'asistances' =>  $asistancesRes
            ];
        } catch (Exception $e) {
            $c = $this;
            return response($e->getMessage(),   __FUNCTION__);
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
     * @param  \App\Http\Requests\StoreAssistanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $code = $request->code;
            $customer = Customer::where('code', $code)->first();
            if (!$customer) return response('User not found', 404);
            $branch = Branch::where('id', $request->branch)->first(); //It be found by ip ? or aautenticatin manager
            if (!$branch) return response('Branch not found', 404);

            $customer = Customer::where('id', $customer->id)->with(['membership' => function ($q) use ($customer) {
                $q->with(['payments' => function ($q1) use ($customer) { //->where('customer_id', $customer->id)
                    $q1->orderBy('expires_at', 'desc')->first();
                }]);
            }])->first();

            $data = [
                'customer_id' => $customer->id,
                'input' => date("Y-m-d H:i:s"),
                'branch_id' => $branch->id, // By location (Maybe ip)
            ];

            /*  $assisted = Assistance::where('customer_id', $customer->id)
                ->where('branch_id', $branch->id)
                ->orderBy('input', 'desc')
                ->first();

            $resp = null;
            if ($assisted && $assisted['input'] != null && $assisted['output'] == null) {
                $assisted->output = date("Y-m-d H:i:s");
                $assisted->save();
                $resp =  ['salida' => $assisted, 'customer' => $customer];
            } else {
                $resp =  ['entrada' => Assistance::create($data), 'customer' => $customer];
            } */
            $resp =  ['entrada' => Assistance::create($data), 'customer' => $customer];
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
