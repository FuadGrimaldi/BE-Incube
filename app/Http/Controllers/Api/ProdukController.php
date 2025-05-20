<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\ResponseCostum;
use App\Models\Produk;
use App\Http\Requests\ProdukRequest;  
use App\Http\Resources\ProdukResource;  
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $produks = Produk::all();

            if ($produks->isEmpty()) {
                return ResponseCostum::error(null, 'No products found', 404);
            }

            return ResponseCostum::success(ProdukResource::collection($produks), 'Products retrieved successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in ProdukController@index: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukRequest $request)
    {
        try {
            $validate = $request->validated();
            $validate['pass_access'] = Str::random(10);
            $produk = Produk::create($validate);

            return ResponseCostum::success(new ProdukResource($produk), 'Product created successfully', 201);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in ProdukController@store: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $produk = Produk::find($id);

            if (!$produk) {
                return ResponseCostum::error(null, 'Product not found', 404);
            }

            return ResponseCostum::success(new ProdukResource($produk), 'Product retrieved successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in ProdukController@show: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukRequest $request, string $id)
    {
        try {
            $produk = Produk::find($id);

            if (!$produk) {
                return ResponseCostum::error(null, 'Product not found', 404);
            }

            $produk->update($request->validated());

            return ResponseCostum::success(new ProdukResource($produk), 'Product updated successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in ProdukController@update: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $produk = Produk::find($id);

            if (!$produk) {
                return ResponseCostum::error(null, 'Product not found', 404);
            }

            $produk->delete();

            return ResponseCostum::success(null, 'Product deleted successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in ProdukController@destroy: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
