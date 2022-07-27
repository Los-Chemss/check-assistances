<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Branch;
use App\Models\Sale;
use App\Models\SelledProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
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

            $sales = sale::when($criterio && $buscar, function ($q) use ($criterio, $buscar) {
                if ($criterio === 'quantity') {
                    $q->where($criterio, "LIKE", "%$buscar%");
                }
            })->join('products', function ($j) use ($criterio, $buscar) {
                $j->on('products.id', 'sales.product_id')
                    ->when(
                        $criterio === 'product' && $buscar != null,
                        function ($q) use ($criterio, $buscar) {
                            $q->where('name', 'like', "%$buscar%");
                        }
                    );
            })
                ->select('sales.id', 'sales.quantity', 'products.name', 'products.sale_price', 'sales.created_at')
                ->paginate();

            return [
                'pagination' => [
                    'total'        => $sales->total(),
                    'current_page' => $sales->currentPage(),
                    'per_page'     => $sales->perPage(),
                    'last_page'    => $sales->lastPage(),
                    'from'         => $sales->firstItem(),
                    'to'           => $sales->lastItem(),
                ],
                'sales' => $sales
            ];


            $buscar = $request->buscar;
            $criterio = $request->criterio;
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
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // return $request;
            $user = Auth::user();
            $branch = Branch::where('id', $user->branch_id)->first();
            if (!isset($branch->id)) {
                return response("Branch not found", 404);
            }
            if (!isset($request->products)) {
                return response("No products selected", 422);
            }
            $products = $request->products;
            $customer = null;
            $newSale['user_id'] = $user->id;
            $newSale['branch_id'] = $branch->id;
            /*  if (isset($customer->id)) {
                $newSale['customer_id'] = $customer->id;
            } */
            $sale = Sale::create($newSale);
            foreach ($products as $product) {
                if ($product['quantity'] > 0) {
                    $sell['product_id'] = $product['id'];
                    $sell['quantity'] = $product['quantity'];
                    $sell['price'] = $product['sale_price'];
                    $sell['sale_id'] = $sale->id;
                    SelledProduct::create($sell);
                }
            }
            return response('Sale created', 201);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
