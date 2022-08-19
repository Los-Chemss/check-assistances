<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use App\Http\Requests\StoreAssistanceRequest;
use App\Http\Requests\UpdateAssistanceRequest;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Google\Service\AnalyticsData\OrderBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $asistances = Assistance::with(['customer' => function ($q) use ($criterio, $buscar) {
                if (isset($buscar) && in_array($criterio, ['code', 'name', 'income'])) {
                    $criterio === 'name' ?
                        $q->where('name', 'LIkE', '%' . $buscar . '%')
                        ->orWhere('lastname', 'LIkE', '%' . $buscar . '%')
                        : ($criterio === 'income' ?
                            $q->where('income', '>=', date('ymd', strtotime($buscar))) :
                            $q->where('code', 'LIkE', '%' . $buscar . '%'));
                }
            }])
                ->with(['branch' => function ($q)  use ($criterio, $buscar) {
                    if (isset($buscar) && $criterio === 'branch') {
                        $q->where('division', 'LIKE', '%' . $buscar . '%');
                    }
                }])
                ->orderBy('input', 'desc')
                ->paginate(10);
            // return $asistances;

            $asistancesRes = [];
            foreach ($asistances as $as) {
                array_push($asistancesRes, [
                    'id' => $as->id,
                    'nombre' => isset($as->customer) ? $as->customer->name : null,
                    'entrada' => $as->input,
                    // 'salida' => $as->output,
                    'sucursal' => isset($as->branch) ? $as->branch->division : null,
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
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }
    public function customerAsistances(Request $request, $customer)
    {
        try {
            $buscar = $request->buscar;
            $criterio = $request->criterio;

            $asistances = Assistance::where('customer_id', $customer)
                ->with('customer')
                ->with('branch')
                ->when($buscar && $criterio, function ($q) use ($criterio, $buscar) {
                    if ($criterio === 'income') {
                        $q->where('income', '>=', date('ymd', strtotime($buscar)));
                    }
                })
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
            $user = User::where('id', Auth::user()->id)->first();
            if (!$user) return response('User not found', 404);
            $code = $request->code;
            $customer = Customer::where('code', $code)->first();
            if (!$customer) return response('Customer not found', 404);
            $branch = Branch::where('id', $user->branch_id)->first(); //It be found by ip ? or aautenticatin manager
            if (!$branch) return response('Branch not found', 404);
            /*   $customer = Customer::where('id', $customer->id)
                ->with('membership')
                ->with('payments', function ($q) {
                    $q->orderBy('expires_at', 'desc')->first();
                })
                ->first(); */
            $customer = Customer::where('id', $customer->id)->with(['membership' => function ($q) use ($customer) {
                $q->with(['payments' => function ($q1) use ($customer) { //->where('customer_id', $customer->id)
                    $q1->where('customer_id', $customer->id)->orderBy('expires_at', 'desc')->first();
                }]);
            }])->first();

            /* ->with(['membership' => function ($q) use ($customer) {
                   /*  $q->with(['payments' => function ($q1) use ($customer) { //->where('customer_id', $customer->id)
                        $q1->orderBy('expires_at', 'desc')->first();
                    }]); * /
                }]) */

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
