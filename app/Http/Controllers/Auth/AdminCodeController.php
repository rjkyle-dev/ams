<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCodeController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        if ($request->code === '101623') {
            session(['admin_code_verified' => true]);
            return redirect()->route('register');
        }

        return back()->with('error', 'Incorrect Admin Code!');
    }
}
