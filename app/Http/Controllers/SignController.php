<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class SignController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|max:16|min:6',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->passes()) {
            User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
