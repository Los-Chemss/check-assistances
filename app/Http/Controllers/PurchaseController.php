<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Branch;
use App\Models\Purchase;
use App\Models\PurchasedProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
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

            $sales = Purchase::when($criterio && $buscar, function ($q) use ($criterio, $buscar) {
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
                ->select('purchases.id', 'purchases.quantity', 'products.name', 'products.sale_price', 'purchases.created_at')
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
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
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
            $newPurchase['user_id'] = $user->id;
            $newPurchase['branch_id'] = $branch->id;
            // if (isset($customer->id)) {
            //     $newPurchase['customer_id'] = $customer->id;
            // }
            $purchase = Purchase::create($newPurchase);
            foreach ($products as $product) {
                if ($product['quantity'] > 0) {
                    $purc['product_id'] = $product['id'];
                    $purc['quantity'] = $product['quantity'];
                    $purc['price'] = $product['purchase_price'];
                    $purc['purchase_id'] = $purchase->id;
                    PurchasedProduct::create($purc);
                }
            }
            return response('Purchase created', 201);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
