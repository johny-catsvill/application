<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function auth(Request $request) {


        if(auth()->user()) {
            return redirect()->route('account');
        }

        if($request->isMethod('post')) {


            $validator = Validator::make($request->all(), [
                'login' => 'required',
                'password' => 'required'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            if (auth()->attempt(['login' => $request->login, 'password' => $request->password])) {
                return redirect()->route('account');
            }
            else {

                return redirect()->back()->withInput();
            }

        }

        return view('login');

    }
}
