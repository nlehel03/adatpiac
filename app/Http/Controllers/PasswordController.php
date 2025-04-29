<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ResetPassword;

class PasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Nincs felhasználó ezzel az email címmel.',
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $request->email)->first();

        Mail::to($request->email)->send(new ResetPassword($user, $token));

        return back()->with('success', 'Jelszó-visszaállítási linket küldtünk az email címére.');
    }
    public function showResetPasswordForm($email, $token)
    {
        $email = urldecode($email);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$tokenData) {
            return redirect()->route('password.request')
                ->with('error', 'Érvénytelen jelszó-visszaállítási link.');
        }

        if (Carbon::parse($tokenData->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect()->route('password.request')
                ->with('error', 'A jelszó-visszaállítási link lejárt. Kérjen újat.');
        }

        return view('auth.reset-password', [
            'email' => $email,
            'token' => $token
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$tokenData) {
            return redirect()->route('password.request')
                ->with('error', 'Érvénytelen jelszó-visszaállítási link.');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'A jelszava sikeresen megváltozott. Most már bejelentkezhet az új jelszavával.');
    }
}
