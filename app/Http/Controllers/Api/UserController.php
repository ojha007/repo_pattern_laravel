<?php

namespace App\Http\Controllers\Api;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $user)
    {
//        $this->middleware('auth:api');
        $this->model = $user;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            return response()->json(
                [
                    'user' => $user,
                    'role' => $user->role,
                    'token' => $user->createToken('api_client')->accessToken
                ], Response::HTTP_OK);
        } else {
            return response()->json(['errors' => [['Email/Password doesnt match our record ']]], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = $this->model->create($input);
        $success['token'] = $user->createToken('api_client')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['message' => 'User Created SuccessFully'], Response::HTTP_OK);
    }

    public function show()
    {
        $user = auth('api')->user();
        return response()->json([
            'user' => $user,
            'permissions' => $user->getAllPermissions(),
            'role' => $user->getRoleNames(),
        ], Response::HTTP_OK);
    }
}
