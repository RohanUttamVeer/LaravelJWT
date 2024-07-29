<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\UserDetailRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_all_users()
    {
        return ResponseHelper::success(
            message: 'All users fetched!',
            data: User::all(),
            statusCode: 200,
            status: 'success',
        );
    }

    public function get_user()
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
                message: 'User details error!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }

    public function update_user(UserDetailRequest $request)
    {
        try {
            $validateData = $request->validated();

            auth('api')->user()->update([
                "name" => $validateData['name'],
                "email" => $validateData['email'],
                "image" => $validateData['image'],
                "phone" => $validateData['phone'],
                "address" => $validateData['address'],
                "latitude" => $validateData['latitude'],
                "longitude" => $validateData['longitude'],
                'updated_at' => now(),
            ]);


            return ResponseHelper::success(
                message: 'User updated successfully!',
                data: auth('api')->user(),
                statusCode: 200,
                status: 'success',
            );

        } catch (\Exception $e) {
            \Log::error('User update exception : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not updated!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }
    public function delete_user()
    {
        try {
            auth('api')->user()->delete();
            return ResponseHelper::success(
                message: 'User deleted successfully!',
                data: null,
                statusCode: 200,
                status: 'success',
            );

        } catch (\Exception $e) {
            \Log::error('User delete exception : ' . $e->getMessage() . 'Line number : ' . $e->getLine());
            return ResponseHelper::error(
                message: 'User not deleted!',
                statusCode: 400,
                status: 'failure',
            );
        }
    }
}
