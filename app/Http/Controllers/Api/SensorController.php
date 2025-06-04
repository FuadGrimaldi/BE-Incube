<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceSetting;
use Illuminate\Support\Facades\Log;
use App\Helpers\ResponseCostum;
use App\Http\Requests\DataProdukRequest;

class SensorController extends Controller
{
    public function getDeviceSetting($device_id)
    {
        // Simulasikan ambil data dari DB
        $threshold = DeviceSetting::where('id_produk', $device_id)->first();

        return response()->json([
            'success' => true,
            'data' => $threshold,
        ]);
    }

    public function updateThreshold(Request $request, $device_id)
    {
        try {
            // Validasi input
            $request->validate([
                'min_suhu' => 'required|numeric',
                'max_suhu' => 'required|numeric',
            ]);
            $validatedData = $request->only(['min_suhu', 'max_suhu']);
            $threshold = DeviceSetting::where('id_produk', $device_id)->first();

            if (!$threshold) {
                return ResponseCostum::error(null, 'Device not found', 404);
            }

            $threshold->update($validatedData);

            return ResponseCostum::success($threshold, 'Threshold updated successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in updateThreshold: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function updateFanStatus(Request $request, $device_id)
    {
        try {
            // Validasi input
            $request->validate([
                'fan' => 'required|in:ON,OFF,AUTO',
            ]);
            $validatedData = $request->only(['fan']);
            $fanStatus = DeviceSetting::where('id_produk', $device_id)->first();

            if (!$fanStatus) {
                return ResponseCostum::error(null, 'Device not found', 404);
            }

            $fanStatus->update($validatedData);

            return ResponseCostum::success($fanStatus, 'Fan status updated successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in updateFanStatus: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function updateLampuStatus(Request $request, $device_id)
    {
        try {
            // Validasi input
            $request->validate([
                'lampu' => 'required|in:ON,OFF,AUTO',
            ]);
            $validatedData = $request->only(['lampu']);
            $lampuStatus = DeviceSetting::where('id_produk', $device_id)->first();

            if (!$lampuStatus) {
                return ResponseCostum::error(null, 'Device not found', 404);
            }

            $lampuStatus->update($validatedData);

            return ResponseCostum::success($lampuStatus, 'Lamp status updated successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in updateLampuStatus: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
