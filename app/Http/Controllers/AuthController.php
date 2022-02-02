<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends Controller
{
    public function __construct() {
        //$this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    // public function register(Request $request)
    // {
    //     return User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password'))
    //     ]);
    // }

    // public function login(Request $request)
    // {
    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response([
    //             'message' => 'Invalid credentials!'
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }

    //     $user = Auth::user();

    //     $token = $user->createToken('token')->plainTextToken;

    //     $cookie = cookie('jwt', $token, 60 * 24); // 1 day

    //     return response([
    //         'message' => $token
    //     ])->withCookie($cookie);
    // }

    // public function user()
    // {
    //     return Auth::user();
    // }

    // public function logout()
    // {
    //     $cookie = Cookie::forget('jwt');

    //     return response([
    //         'message' => 'Success'
    //     ])->withCookie($cookie);
    // }
    ////////////////////////////////////////////////////////////////////////////////


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //dd($token);
        //return $this->createNewToken($token);
        //return $token;
        $user = Auth::user();
        $user->createToken('token');
        //return view('admin.home');
        $cookie = cookie('jwt', $token, 60 * 24); // 1 day
        return redirect('/?$token'.$token)->withCookie($cookie);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'user' => $user
        // ], 201);

        return redirect('/login');
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        $cookie = Cookie::forget('jwt');
        auth()->logout();
        return redirect('/login');

        //return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
