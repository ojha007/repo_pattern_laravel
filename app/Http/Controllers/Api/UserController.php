<?php

namespace App\Http\Controllers\Api;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ], [
            'email.exists' => 'The email does not exists'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            return response()->json(
                [
                    'user' => $user,
                    'token' => $user->createToken('api_client')->accessToken
                ], Response::HTTP_OK);
        } else {
            throw ValidationException::withMessages(['no_record' => 'Email/Password doesnt match our record']);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
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
