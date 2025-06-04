<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;  
use App\Models\Address;
use App\Helpers\ResponseCostum;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AddressRequest;  

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $addresses = Address::with('user')->get();
            if ($addresses->isEmpty()) {
                return ResponseCostum::error(null, 'No addresses found', 404);
            }
            return ResponseCostum::success(AddressResource::collection($addresses), 'Addresses retrieved successfully', 200);

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
    public function store(AddressRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $address = Address::create($validatedData);
            return ResponseCostum::success(new AddressResource($address), 'Address created successfully', 201);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in store: ' . $e->getMessage(), [
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
            $address = Address::with('user')->find($id);
            if (!$address) {
                return ResponseCostum::error(null, 'Address not found', 404);
            }
            return ResponseCostum::success(new AddressResource($address), 'Address retrieved successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in show: ' . $e->getMessage(), [
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
    public function update(AddressRequest $request, string $id)
    {
         try {
            $address = Address::find($id);
            if (!$address) {
                return ResponseCostum::error(null, 'Address not found', 404);
            }

            $validatedData = $request->validated();
            $address->update($validatedData);

            return ResponseCostum::success(new AddressResource($address), 'Address updated successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in update: ' . $e->getMessage(), [
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
            $address = Address::find($id);
            if (!$address) {
                return ResponseCostum::error(null, 'Address not found', 404);
            }
            $address->delete();
            return ResponseCostum::success(null, 'Address deleted successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in destroy: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function updateAddress(AddressRequest $request)
    {
        try {
            $user = auth()->user();
            $address = Address::where('id_user', $user->id)->first();
            if (!$address) {
                return ResponseCostum::error(null, 'Address not found', 404);
            }
            $validatedData = $request->validated();
            $address->update($validatedData);
            return ResponseCostum::success(new AddressResource($address), 'Address updated successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in update Address: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function addressByUserSignIn() {
        try {
            $user = auth()->user();
            $address = Address::where('id_user', $user->id)->first();
            if (!$address) {
                return ResponseCostum::error(null, 'Address not found', 404);
            }
            return ResponseCostum::success(new AddressResource($address), 'Address retrieved successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in addressByUserSignIn: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function storeAddressByUserLogin(AddressRequest $request) {
        try {
            $user = auth()->user();
            $validatedData = $request->validated();
            $validatedData['id_user'] = $user->id; // Set the user ID from the authenticated user
            $address = Address::create($validatedData);
            return ResponseCostum::success(new AddressResource($address), 'Address created successfully', 201);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in storeAddressByUserLogin: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
