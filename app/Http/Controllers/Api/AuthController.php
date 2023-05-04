<?php

namespace App\Http\Controllers\Api;


use Validator;
use App\Models\Api\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;


class AuthController extends Controller
{
    private $credentials;
    private $data;
    public function show()
    {
        $data = auth()->user();
        return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function generateUniqueNumber()
    {
        do {
            // $code = random_int(100000, 999999);
            $code = random_int(1000, 9999);
        } while (User::where("pin", "=", $code)->first());

        return $code;
    }

    public function register(Request $request, User $user)
    {
        //validate incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => "required",
            'last_name' => "required",
            'username' => 'required|unique:users|max:20',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|min:3', // ['required', 'min:3', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[-]).*$/',]
            'phone' => 'required|numeric|unique:users',
            'pin' => 'unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            // try {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->address = $request->input('address');

            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->phone = $request->input('phone');
            if (!empty($request->pin)) {
                $user->role = $request->role;
                $user->pin = $request->pin;
            }
            if ($user->save()) {
                return $this->login($request);
            }
            return response()->json(['user' => $user, 'message' => 'User Created Succesfully', 'err' => $err], 201);
            // } catch (\Exception $e) {
            //     return response()->json(['message' => 'User Registration Failed!'], 409);
            // }
        }
    }
    public function login(Request $request)
    {
        if (!$request->pin) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
        }

        if (!$request->pin ? $validator->fails() : null) {
            if (!$request->pin) {
                return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
            }
        } else {
            if ($request->pin) {
                // $test = $request->only([ 'email', 'password']);
                $credentials = User::select('email', 'password')->where('pin', $request->pin)->first();
                $data = User::where('email', $credentials['email'])->first();
            } else {
                $credentials = $request->only(['email', 'password']);
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    $token = $user->createToken('auth_token')->plainTextToken;
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'user does not exist'], 401);
                }
            }

            return response()->json(['status' => 'success', 'message' => 'user logged in successfully', 'token' => $token], 200);
        }
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 'success', 'message' => 'User has been logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function getUserOther(Request $request)
    {
        // dd(auth()->user());

        // $token = JWTAuth::getToken();
        // $apy = JWTAuth::getPayload($token)->toArray();
        // dd($apy);
        // if ($request->query('userId')) {
        //     $data = User::findOrFail($request->query('userId'));
        //     if ($data->role == "cashier" || $data->role == "kitchen") {
        //         return response()->json(['status' => 'success', 'data' => $data]);
        //     } else {
        //         return response()->json(['status' => 'failed', 'error' => "No Data Available in this Query!!"]);
        //     }
        // }
    }

    public function sendCode(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'pin' => 'unique:users|max:4'

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'val_err', 'val_err' => $validator->errors()]);
        } else {
            $user->pin = $this->generateUniqueNumber();
            return response()->json(['code' => 200, 'status' => 'success', 'message' => "Code generate successfully!", 'data' => $user]);
        }
    }
}
