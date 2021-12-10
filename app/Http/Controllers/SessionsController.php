<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes=request()->validate([
            'email'=>'required|exists:Users,email',
            'password'=>'required',
        ]);

        if (! auth()->attempt($attributes))
        {
            //session fixation
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome Back');
        }

        throw ValidationException::withMessages([
            'email'=> 'Your provided credentials could not be verefied' ]);

        // return back()
        // ->withInput()
        // ->withErrors(['email'=> 'Your provided credentials could not be verefied' ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye');

    }
}
