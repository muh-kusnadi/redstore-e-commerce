<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthPageController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('pages.front.auth', ['headerColor' => true]);
    }

    public function postLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            $user = Auth::user();
            $resArr = [];
            $resArr['token']    = $user->createToken('redStore-application')->accessToken;
            $resArr['name']     = $user->name;

            Log::info(['resArr' => $resArr]);

            return redirect()->route('front.index');
        }

        return redirect()->back()->withErrors('Failed to Register!');
    }

    public function postRegister(Request $request)
    {
        
        // $validated = $request->validate([
        //     'name'                  => 'required',
        //     'email'                 => 'required|email',
        //     'password'              => 'required',
        //     'password_confirmation' => 'required|same:password',
        // ]);
        
        // if($validated->fails()) {
            //     redirect()->back()->withErrors($validated->errors());
            // }
                
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = $this->user->create($data);

        if($user) {
            $resArr = [];
            $resArr['token']    = $user->createToken('redStore-application')->accessToken;
            $resArr['name']     = $user->name;

            Log::info(['resArr' => $resArr]);

            Auth::login($user);

            return redirect()->route('front.index');
        }

        return redirect()->back()->withErrors('Failed to Register!');
    }

    public function roar()
    {
        return 'test';
    }

    public function postLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('front.index');
    }
}
