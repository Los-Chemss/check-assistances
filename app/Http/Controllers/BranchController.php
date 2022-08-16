<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
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
            $buscar = json_decode($buscar);

            $user = Auth::user();
            $branches = Branch::with(['payments' => function ($q) use ($criterio, $buscar) {
                if ($criterio === 'between_dates') {

                    if (isset($buscar->from)) {
                        $searchVal = date($buscar->from);
                        $q->where('paid_at', '>=', "$searchVal");
                    }
                    if (isset($buscar->to)) {
                        $searchVal = date($buscar->to);
                        $q->where('paid_at', '<=', "$searchVal");
                    }
                }
            }])
                ->With('sales')
                ->With('purchases')
                ->where(function ($q) use ($criterio, $buscar) {
                    if ($criterio === 'division') {
                        $q->where('branches.division', 'LIKE', "%$buscar%");
                    }
                    if ($criterio === 'location') {
                        $q->where('branches.location', 'LIKE', "%$buscar%");
                    }
                })
                ->paginate(10);
            $branchesRes = [];
            foreach ($branches as $branch) {
                $paymentsSum = 0;
                $paymentsCount = 0;
                $salesSum = 0;
                $salesCount = 0;
                $purchasesSum = 0;
                $purchaseCount = 0;
                if (isset($branch->payments)) {
                    foreach ($branch->payments as $pay) {
                        $paymentsSum = $paymentsSum + $pay['amount'];
                        $paymentsCount = $paymentsCount + 1;
                    }
                }
                if (isset($branch->sales)) {
                    foreach ($branch->sales as $pay) {
                        $salesSum = $salesSum + $pay->amount;
                        $salesCount = $salesCount + 1;
                    }
                }
                if (isset($branch->purchases)) {
                    foreach ($branch->purchases as $pay) {
                        $purchasesSum = $purchasesSum + $pay->amount;
                        $purchaseCount = $purchaseCount + 1;
                    }
                }
                array_push(
                    $branchesRes,
                    [
                        'id' => $branch->id,
                        'division' => $branch->division,
                        'location' => $branch->location,
                        'payments_count' => $paymentsCount,
                        'payments_sum' => $paymentsSum,
                        'sales_count' => $salesCount,
                        'sales_sum' => $salesSum,
                        'purchases_count' => $purchaseCount,
                        'purchases_sum' => $purchasesSum,
                    ]
                );
            }
            return [
                'pagination' => [
                    'total'        => $branches->total(),
                    'current_page' => $branches->currentPage(),
                    'per_page'     => $branches->perPage(),
                    'last_page'    => $branches->lastPage(),
                    'from'         => $branches->firstItem(),
                    'to'           => $branches->lastItem(),
                ],
                'branches' => $branchesRes
            ];
            return response()->json($branches);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }

        // return Branch::all();
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
     * @param  \App\Http\Requests\StoreBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        return Branch::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return $branch;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchRequest  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->update($request->all());
        return $branch;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return response()->json();
    }

    public function select()
    {
        return Branch::all();
    }
}
