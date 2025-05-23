<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseCostum;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\DetailUser;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::with('detail')->get();
            if ($users->isEmpty()) {
                return ResponseCostum::error(null, 'No users found', 404);
            }
            return ResponseCostum::success(UserResource::collection($users), 'Users retrieved successfully', 200);

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
    public function store(UserRequest $request)
    {
        try {
            $user = auth()->user(); // dari middleware jwt.verify
            if (!$user) {
                return ResponseCostum::error(null, 'User not found', 404);
            }
            $data = $request->validated();
            $data['id_user'] = $user->id;

            // Upload file ke S3 jika ada
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $path = $file->store('profile_pictures', 's3'); // folder di bucket
                $url = Storage::disk('s3')->url($path);
                $data['profile_picture'] = $url;
            }

            $detailUser = DetailUser::create($data);
            $user->detail()->save($detailUser);

            return ResponseCostum::success(new UserResource($user), 'User created successfully', 201);

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
            $user = User::findOrFail($id);
            if (!$user) {
                return ResponseCostum::error(null, 'User not found', 404);
            }
            return ResponseCostum::success(new UserResource($user), 'User retrieved successfully', 200);

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
    public function update(UserRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            // Hapus relasi detail jika ada
            $user->detail()->delete();
            $user->delete();

            return ResponseCostum::success(null, 'User deleted successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in destroy: ' . $e->getMessage(), ['exception' => $e]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function profile()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return ResponseCostum::error(null, 'User not found', 404);
            }
            return ResponseCostum::success(new UserResource($user), 'User profile retrieved successfully', 200);

        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in profile: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
    public function updateProfile(UserRequest $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return ResponseCostum::error(null, 'User not found', 404);
            }
            $data = $request->validated();
            if (!$user->detail) {
            return ResponseCostum::error(null, 'User detail not found', 404);
        }
            $user->detail->update($data);
            return ResponseCostum::success(new UserResource($user), 'User profile updated successfully', 200);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Error in updateProfile: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return ResponseCostum::error(null, 'An error occurred: ' . $e->getMessage(), 500);
        }
    }
}

