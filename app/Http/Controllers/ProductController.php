<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
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

            $products = Product::when($criterio && $buscar, function ($q) use ($criterio, $buscar) {
                if ($criterio === 'name' || $criterio === 'description' || $criterio === 'purchase_price' || $criterio === 'sale_price') {
                    $q->where($criterio, "LIKE", "%$buscar%");
                }
            })->select('id', 'name', 'description', 'purchase_price', 'sale_price')
                ->paginate();

            return [
                'pagination' => [
                    'total'        => $products->total(),
                    'current_page' => $products->currentPage(),
                    'per_page'     => $products->perPage(),
                    'last_page'    => $products->lastPage(),
                    'from'         => $products->firstItem(),
                    'to'           => $products->lastItem(),
                ],
                'products' => $products
            ];
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }

    public function select(Request $request)
    {
        try {
            return Product::select('id', 'name')->get();
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $newProduct = [];
            foreach ($request->all() as $key => $val) {
                $newProduct[$key] = $val;
            }
            Product::create($newProduct);
            return response()->json('Product created', 201);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        try {
            $product = Product::where('id', $request->id)->first();
            if (isset($request)) {
                foreach ($request->all() as $key => $val) {
                    $product[$key] = $val;
                }
                $product->save();
                return response()->json('Product updated', 200);
            }
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $product = Product::where('id', $id)->first();
            if (!$product) return response('No found', 404);
            $product->delete();
            return response('deleted', 200);
        } catch (Exception $e) {
            $c = $this;
            return $this->catchEx($e->getMessage(), $c,  __FUNCTION__ . ' | ' . $e->getLine());
        }
    }
}
