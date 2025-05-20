<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseCostum;
use App\Http\Requests\UserSubRequest;
use App\Models\UserSub;
use App\Http\Resources\UserSub as UserSubResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserSubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subs = UserSub::all();
            if ($subs->isEmpty()) {
                return ResponseCostum::error(null, 'No subscriptions found', 404);
            }
            return ResponseCostum::success(UserSubResource::collection($subs), 'Subscriptions retrieved successfully', 200);
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
    public function store(UserSubRequest $request)
    {
        try {
            $validated = $request->validated();
            $startSub = now(); // Tanggal saat ini
            $endSub = now()->addDays(30); // 30 hari setelahnya
            $sub = UserSub::create([
                'id_cus'     => $validated['id_cus'],
                'id_produk'  => $validated['id_produk'],
                'start_sub'  => $startSub,
                'end_sub'    => $endSub,
            ]);
            return ResponseCostum::success(new UserSubResource($sub), 'Subscription created successfully', 201);
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
            $sub = UserSub::find($id);
            if (!$sub) {
                return ResponseCostum::error(null, 'Subscription not found', 404);
            }
            return ResponseCostum::success(new UserSubResource($sub), 'Subscription retrieved successfully', 200);
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
    public function update(Request $request, string $id)
    {
        try {
            $sub = UserSub::find($id);
            if (!$sub) {
                return ResponseCostum::error(null, 'Subscription not found', 404);
            }
            $sub->update($request->validated());
            return ResponseCostum::success(new UserSubResource($sub), 'Subscription updated successfully', 200);
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
            $sub = UserSub::find($id);
            if (!$sub) {
                return ResponseCostum::error(null, 'Subscription not found', 404);
            }
            $sub->delete();
            return ResponseCostum::success(null, 'Subscription deleted successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in destroy: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function showUserSubByIdLogin()
    {
        try {
            $userId = auth()->user()->id;
            $sub = UserSub::where('id_cus', $userId)->get();

            if (!$sub) {
                return ResponseCostum::error(null, 'Subscription not found for this user', 404);
            }

            return ResponseCostum::success(UserSubResource::collection($sub), 'User subscription retrieved successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in showUserSubByIdLogin: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
