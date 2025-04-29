<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\VerifyEmail;

class UserController extends Controller
{
    public function storeUser(Request $request)
    {
        // Validáció
        $validated = $request->validate([
            'nev' => 'required|string|max:30',
            'iranyitoszam' => 'required|numeric|digits_between:1,4',
            'varos' => 'required|string|max:30',
            'utca' => 'required|string|max:30',
            'hazszam' => 'required|string|max:15',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:50|unique:users,email',
            'szemelyigszam' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);
        $verificationToken = Str::random(64);
        unset($validated['password_confirmation']);
        $userData = [
            'nev' => $validated['nev'],
            'iranyitoszam' => $validated['iranyitoszam'],
            'varos' => $validated['varos'],
            'utca' => $validated['utca'],
            'hazszam' => $validated['hazszam'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'szemelyigszam' => $validated['szemelyigszam'],
            'cegjegyzekszam' => null,
            'tipus' => 'p',
            'password' => Hash::make($validated['password']),
            'verification_token' => $verificationToken,
        ];
        $userId = DB::table('users')->insertGetId($userData);
        $user = User::where('id', $userId)->firstOrFail();
        Mail::to($user->email)->send(new VerifyEmail($user, $verificationToken));


        // Visszairányítás sikerüzenettel
        return redirect()->route('login')->with('success', 'Sikeres felhasználó regisztráció!');
    }
    public function storeCompany(Request $request)
    {
        // Validáció
        $validated = $request->validate([
            'nev' => 'required|string|max:30',
            'iranyitoszam' => 'required|numeric|digits_between:1,4',
            'varos' => 'required|string|max:30',
            'utca' => 'required|string|max:30',
            'hazszam' => 'required|string|max:15',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|max:50|unique:users,email',
            'cegjegyzekszam' => 'required|string|max:12',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);
        $verificationToken = Str::random(64);
        unset($validated['password_confirmation']);
        $userData = [
            'nev' => $validated['nev'],
            'iranyitoszam' => $validated['iranyitoszam'],
            'varos' => $validated['varos'],
            'utca' => $validated['utca'],
            'hazszam' => $validated['hazszam'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'szemelyigszam' => null,
            'cegjegyzekszam' => $validated['cegjegyzekszam'],
            'tipus' => 'c',
            'password' => Hash::make($validated['password']),
            'verification_token' => $verificationToken,
        ];
        $userId = DB::table('users')->insertGetId($userData);
        $user = User::find($userId);
        Mail::to($user->email)->send(new VerifyEmail($user, $verificationToken));

        return redirect()->route('login')->with('success', 'Sikeres cég regisztráció!');
    }

    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $keres)
    {
        $hitelesito = $keres->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
        $user = User::where('email', $keres->email)->first();
        if ($user && $user->email_verified_at === null) {
            return redirect()->route('verification.notice')
            ->with('error', 'Kérjük, erősítse meg az e-mail címét a bejelentkezés előtt!');

        }
        if (Auth::attempt(['email' => $keres->email, 'password' => $keres->password])) {
            $keres->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'A megadott adatok érvénytelenek.',
        ])->onlyInput('email');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Sikeres kijelentkezés!');
    }
    public function verifyEmail($id, $token)
    {
        // Keressük meg a felhasználót
        $user = User::findOrFail($id);

        // Debug információ (fejlesztés közben hasznos)
        \Log::info("Email megerősítés megkísérelve:", [
            'user_id' => $id,
            'token_sent' => $token,
            'token_stored' => $user->verification_token,
            'email_verified_at' => $user->email_verified_at
        ]);

        // Ellenőrizzük, hogy érvényes-e a token
        if ($user->verification_token !== $token) {
            return redirect()->route('login')->with('error', 'Érvénytelen megerősítő link!');
        }

        // Ellenőrizzük, hogy már megerősített-e
        if ($user->email_verified_at !== null) {
            return redirect()->route('login')->with('info', 'Ez az email cím már korábban meg lett erősítve.');
        }

        // Megerősítés és adatbázis frissítés
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        // Log a sikeres művelethez
        \Log::info("Email sikeresen megerősítve:", [
            'user_id' => $id,
            'email' => $user->email
        ]);

        return redirect()->route('login')->with('success', 'Sikeres email cím megerősítés! Most már bejelentkezhet.');
    }
    public function showVerificationNotice()
    {
        return view('auth.verify-email');
    }
    public function resendVerificationEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Nincs ilyen felhasználó!');
        }
        if ($user->email_verified_at !== null){
            return redirect() ->back()->with('error', 'E-mail cím már megerősítve!');
        }

        // Ez a helyes mód:
        $user->verification_token = Str::random(64);  // Új token generálása
        $user->save();

        Mail::to($user->email)->send(new VerifyEmail($user, $user->verification_token));
        return redirect()->back()->with('success', 'Új megerősítő e-mail elküldve!');
    }
}
