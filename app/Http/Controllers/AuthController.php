<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateInfoRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password) ,
            'role_id' => $request->role_id ?? 1
            
            ]         

        );
        return response(new UserResource($user)
        ,Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if(!auth()->attempt($request->only('email','password'))){
            return response()->json([
                'error'=>"invalid credintial"
            ],Response::HTTP_UNAUTHORIZED);
        }
        $user = auth()->user() ;
        $jwt = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt',$jwt , 60);
         return \response([
            'jwt'=>$jwt
        ])->withCookie($cookie);
    }

    public function user(Request $request)
    {
        $user = $request->user() ;
        
        return new UserResource($user->load('role'));
    }
    public function logout()
    {
        $cookie = cookie()->forget(('jwt'));
        return response()->json([
            'message'=>"success logout"
        ])->withCookie($cookie);
    }
    public function updateInfo(UserUpdateInfoRequest $request)
    {
        $user = $request->user();
        $user->update(
           $request->only('first_name','last_name','email')
       );
       return response(new UserResource($user), Response::HTTP_ACCEPTED);

    }
    public function updatePassword(UserUpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->update(
            [
                "password"=> Hash::make($request->password)
            ]
         );
         return response(new UserResource($user), Response::HTTP_ACCEPTED);

    }
}
