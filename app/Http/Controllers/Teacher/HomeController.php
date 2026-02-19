<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function teacher_login()
    {
        return view('auth.teacher_login');
    }

    public function teacher_login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('teacher.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }
    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function profile()
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->with('teacher')->first();
        return view('teacher.profile.profile', compact('teacher'));
    }

    public function profile_update(Request $request, $teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        $teacher->dob = $request->dob;
        $teacher->gender = $request->gender;
        $teacher->address = $request->address;
        $teacher->nid = $request->nid;
        $teacher->save();

        $user = User::find($teacher->user_id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Profile Updated');
    }
}
