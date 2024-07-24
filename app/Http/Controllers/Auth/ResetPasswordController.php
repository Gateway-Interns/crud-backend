<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\ForgetPasswordRequest;
use App\Http\Requests\auth\ResetPasswordRequest;
use App\Http\Resources\auth\ResetPasswordResource;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{

    public function forget(ForgetPasswordRequest $request){


                $status = Password::sendResetLink($request->only('email'));
                if($status == Password::RESET_LINK_SENT){
                    return new ResetPasswordResource('Link Sent successfully');
                }else{
                    return new ResetpasswordResource('Link Sent Failed');
                }

    }

    public function reset(ResetPasswordRequest $request){
        $status = Password::reset(
            $request->only('email','password','token'),
            function($user,$password) use($request){
                $user -> forceFill([
                    'password' => Hash::make($password),
                ])->save();
                event(new PasswordReset($user));
            }
        );

            if($status == Password::PASSWORD_RESET){
                return new ResetPasswordResource('Password reset successfully.');
            }else{
                return new ResetPasswordResource('Password reset failed.');
            }

    }
}
