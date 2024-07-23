<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;


class ResetPassword extends Controller
{

    public function forget(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=> 'required|email'
        ]);
        if(!$validator->fails()){
                $status = Password::sendResetLink($request->only('email'));
                if($status == Password::RESET_LINK_SENT){
                    return response()->json(['message' => 'Reset link sent successfully.']);
                }else{
                    return 'no';
                }
        }else{
            return 'fails not found';
        }
    }
    public function reset(Request $request){
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);
        if(!$validator->fails()){
            $status = Password::reset(
                $request->only('email','password','token'),
                function($user) use($request){
                    $user -> forceFill([
                        'password' => Hash::make($request->password),
                        //'remember_token' => Str::random(60),
                    ])->save();
                 //   $this->deleteToken($request->token);
                    event(new PasswordReset($user));
                }
            );
            if($status == Password::PASSWORD_RESET){
                return 'reseteedd';
            }else{
                return 'not reseted';
            }
        }
    }
}
