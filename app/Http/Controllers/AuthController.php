<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        try {
            $validateData = $request->validated();

            $user = User::create([
                "name" => $validateData['name'],
                "email" => $validateData['email'],
                'password' => bcrypt($validateData['password']),
            ]);
            // $token = auth('api')->login($user);
            // return $this->respondWithToken($token);

            if ($user) {
                $token = auth('api')->login($user);

                return ResponseHelper::success(
                    message: 'User registered successfully!',
                    data: [
                        'token' => $token,
                    ],
                    // data: $user,
                    // token: $token,
                    statusCode: 201,
                    status: 'success',
                );
            } else {
                return ResponseHelper::error(
                    message: 'User not registered!',
                    statusCode: 400,
                    status: 'failure',
                );
            }
        } catch (Exception $e) {
            Log::error('User register exception : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not registered!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }
    public function login()
    {
        try {
            $credentials = request(['email', 'password']);

            // if (!$token = auth('api')->attempt($credentials)) {
            //     return response()->json(['error' => 'Unauthorized'], 401);
            // }
            // return $this->respondWithToken($token);

            if ($token = auth('api')->attempt($credentials)) {
                return ResponseHelper::success(
                    message: 'User registered successfully!',
                    // data: $user,
                    // token: $token,
                    data: [
                        'token' => $token,
                    ],
                    statusCode: 200,
                    status: 'success',
                );
            } else {
                return ResponseHelper::error(
                    message: 'User not logged in!',
                    statusCode: 400,
                    status: 'failure',
                );
            }
        } catch (\Exception $e) {
            \Log::error('User login exception : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not logged in!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user_detail()
    {
        try {
            // return response()->json(auth('api')->user());
            return ResponseHelper::success(
                message: 'User details fetched!',
                data: auth('api')->user(),
                statusCode: 200,
                status: 'success',
            );
        } catch (\Exception $e) {
            \Log::error('User details exception : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not logged in!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth('api')->logout();
            // $token = auth('api')->user()->getRememberToken();
            // $tokenId = $user->getAuthIdentifier();
            // $user->tokens()->where('id', $tokenId)->delete();
            // JWTAuth::setToken($token)->invalidate();
            // return response()->json(['message' => 'Successfully logged out']);
            return ResponseHelper::success(
                message: 'User logged out successfully!',
                data: null,
                statusCode: 200,
                status: 'success',
            );
        } catch (\Exception $e) {
            \Log::error('User logout exception : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not logged out!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }

    // /**
    //  * Refresh a token.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth('api')->refresh());
    // }

    // /**
    //  * Get the token array structure.
    //  *
    //  * @param  string $token
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth('api')->factory()->getTTL() * 60
    //     ]);
    // }
}