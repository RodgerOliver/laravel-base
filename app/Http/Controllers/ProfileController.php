<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        Auth::user()->update($request->only('name', 'email'));
        if($request->password) {
            Auth::user()->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return redirect()->route('profile')->with('message', 'Profile saved successfully');
    }
}
