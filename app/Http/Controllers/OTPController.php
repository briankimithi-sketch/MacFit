<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class OTPController extends Controller
{
    public function sendOtp()
    {
        $user = auth()->user();   // assuming user is logged in

        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // 👉 send OTP via SMS or EMAIL (placeholder)
        // Mail::to($user->email)->send(new SendOTP($otp));
        // Or integrate SMS API later

        return view('otp.verify', ['user' => $user]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        $user = auth()->user();

        if ($user->otp !== $request->otp) {
            return back()->with('error', 'Invalid OTP');
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'OTP expired');
        }

        // OTP Success
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        return redirect('/dashboard')->with('success', 'OTP Verified!');
    }
}