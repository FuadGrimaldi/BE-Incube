<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseCostum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DetailUser;
use Melihovv\Base64ImageDecoder\Base64ImageDecoder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()){
            return ResponseCostum::error(null, $validator->errors(), 422);
        }

        if ($request->password !== $request->password_confirmation) {
            return ResponseCostum::error(null, 'Password confirmation does not match.', 422);
        }
        if (User::where('email', $request->email)->exists()) {
            return ResponseCostum::error(null,'Email already exists.', 422);
        }


        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
            

        $token = Auth::attempt(['email'=> $request->email, 'password'=>$request->password]);
        $userResponse = getUser($request->email);
        $userResponse->token = $token;
        $userResponse->token_expires_in = auth()->factory()->getTTl()* 60;
        $userResponse->token_type = 'bearer';
        return ResponseCostum::success($userResponse, 'User registered successfully', 201);
    }


    public function login(Request $request) {
        $credentials = $request->only('email','password');        

        $validator = Validator::make($credentials,[
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()){
            return ResponseCostum::error(null, $validator->errors(), 422);
        }

        try {
            if(! $token = auth()->attempt($credentials))
             {
                return ResponseCostum::error(null, 'Invalid email or password', 422);
            }
            $userResponse = getUser($request->email);
            $userResponse->token = $token;
            $userResponse->token_expires_in = auth()->factory()->getTTl()* 60;
            $userResponse->token_type = 'bearer';

            return response()->json([
                'user' => [
                    'id' => $userResponse->id,
                    'name' => $userResponse->name,
                    'email' => $userResponse->email,
                ],
                'access_token' => $token
            ], 200);  ;

        } catch (JWTException $th) {
            return ResponseCostum::error(null, 'Could not create token', 500);
        }
    }
    
    public function refresh(Request $request)
    {
        try {
            $newToken = auth()->refresh();
            return response()->json([
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ], 200);
        } catch (JWTException $e) {
            return ResponseCostum::error(null, 'Token refresh failed', 401);
        }
    }
    public function logout(Request $request) {
        auth()->logout();
        return ResponseCostum::success(null, 'User logged out successfully', 200);
    }

    //menghandle method upload
    private function uploadBase64Image($base64Image) {
        $decoder = new Base64ImageDecoder($base64Image, $allowedFormats = ['jpeg', 'png', 'jpg']);
        $decodedContent = $decoder->getDecodedContent();
        $format = $decoder->getFormat();
        $image = Str::random(10).'.'.$format; //random string qwsedkfkem.png
        Storage::disk('public')->put($image, $decodedContent);

        return $image;
    }
}
