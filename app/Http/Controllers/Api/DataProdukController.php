<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Helpers\ResponseCostum;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\DataProdukResource;  

class DataProdukController extends Controller
{

    public function storeDataFromESP32() {
        //
    }

    
    public function dataProdukByIdProduk(string $id) {
        try {
            $produk = Produk::find($id);
            if (!$produk) {
                return ResponseCostum::error(null, 'Produk not found', 404);
            }

            $dataProduks = DataProduk::where('id_produk', $produk->id)->get();

            if ($dataProduks->isEmpty()) {
                return ResponseCostum::error(null, 'DataProduk not found for this produk_id', 404);
            }

            return ResponseCostum::success(DataProdukResource::collection($dataProduks), 'DataProduk retrieved successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in dataProdukByIdProduk: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = DataProduk::all();
            if ($products->isEmpty()) {
                return ResponseCostum::error(null, 'No products found', 404);
            }
            return ResponseCostum::success(DataProdukResource::collection($products), 'products retrieved successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in index: ' . $e->getMessage(), [
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
