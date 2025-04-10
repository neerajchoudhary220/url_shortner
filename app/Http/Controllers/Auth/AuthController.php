<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm(Request $request)
    {
        $token = $request->token;
        if (!$token) {
            return redirect()->back()->with('error', 'Token is not found');
        }
        $invitation = Invitation::where('token', $token)->firstOrFail();

        return view('auth.register', compact('invitation'));
    }

    public function login(LoginRequest $loginRequest,)
    {
        try {
            $login_inputs = $loginRequest->only('email', 'password');
            if (!Auth::attempt($login_inputs, $loginRequest->remember)) {
                return redirect()->back()->with('error', 'Authentication failed');
            }
            return view('dashboard.index')->with('success', 'Successfully logged in');
        } catch (\Exception $e) {
            logger()->error($e);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $invitation = Invitation::where('token', $request->token)->where('status',false)->firstOrFail();

            $register_data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, //passwrod will be convert to hash using by casting inside the user's model,
                'company_id' => $invitation->company_id,
            ];

            $user = User::create($register_data);
            $user->assignRole($invitation->role);
            $invitation->update(['status'=>true]);
            Auth::login($user);
            DB::commit();
            return redirect()->route('dashboard')
                ->with('success', 'Registration successful! Welcome to your dashboard.');

        } catch (\Exception $e) {
            logger()->error($e);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
