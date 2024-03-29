<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
use App\List_text;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Dotenv\Result\Result;
use Mockery\Undefined;
// use App\DynamicField;
// use JD\Cloudder\Facades\Cloudinary;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\TryCatch;
use Validator;

class UserController extends Controller
{
        


    function landing(Request $request)
    {
        $platforms = List_platform::where('published', 1)->get(['id', 'platform_name', 'logo_image_path', 'platform_regex', 'published'])->toArray();
        $text = List_text::get(['id', 'text'])->toArray();
    return view('components/user/view/landing')->with(['userIsLoggedIn' => $request->session()->get('email'), 
    'platforms' => $platforms,
    'text' => $text]);
    }

    function login(Request $request)
    {
        $data = $request->all();
        $result = User::where('email', $data['email'])->get(['id', 'name', 'email', 'admin', 'password'])->toArray();
        if (!empty($result)) {
            if (Hash::check($data['password'], $result[0]['password'])) {
                // return response()->json(['success' => 'successful login', 'data' => $result[0]]);
                $request->session()->put('email', $result[0]['email']);
                $request->session()->put('id', $result[0]['id']);
                $request->session()->put('admin', $result[0]['admin']);
                return redirect("/dashboard");
            } else {
                return redirect('/login')->with('error', 'Incorrect Username or Password');
                // return response()->json(['error' => 'Email or Username is invalid'], 401);
            }
        } else {
            return redirect('/login')->with('error', 'Incorrect Username or Password');
            // return response()->json(['error' => 'Email or Username is invalid'], 401);
        }
    }


    function register(Request $request)
    {
        $data = $request->all();


        //check if any field empy
        if (in_array(null, $data)) {
            return redirect('/register')->with('error', 'Please complete the registration form');
        }

        if (strlen($data['name']) < 8) {
            // return response()->json(['error' => 'password does not match'], 400);
            return redirect('/register')->with('error', 'Username minimal 8 character');
        }

        if (strlen($data['password']) < 8) {
            // return response()->json(['error' => 'password does not match'], 400);
            return redirect('/register')->with('error', 'Passwords minimal 8 character');
        }

        //check passwords match 
        if ($data['password'] !== $data['confirmPassword']) {
            // return response()->json(['error' => 'password does not match'], 400);
            return redirect('/register')->with('error', 'Passwords does not match');
        }

        $result = User::where('email', $data['email'])->get()->toArray();

        //check exist email
        if (!empty($result)) {
            // return response()->json(['error' => 'Email is already registered'], 400);
            return redirect('/register')->with('error', 'Email is already registered');
        } else {
            $hashed = Hash::make($data['password'], [
                'rounds' => 12,
            ]);

            $user = new User;
            // $student->image_path = $idImage;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $hashed;
            $user->createdAt = date("Y-m-d");
            $user->updatedAt = date("Y-m-d");
            $user->save();

            return redirect('/login')->with('success', 'Account Successfuly created');
        }
    }

    function logout(Request $request)
    {
        Session::flush();
        $request->session()->forget('email');
        $request->session()->forget('id');
        $request->session()->forget('admin');
        return redirect("/");
    }


    function changePassword(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $result = User::where('id', session()->get('id'))->get()->first();
            if (!Hash::check($data['oldpassword'], $result->password)) {
                return response()->json(['error' => 'Password you entered is incorrect'], 400);
            }                    
           if (!$data['password'] ||  !$data['password2'] || !$data['oldpassword'] ) {
            return response()->json(['error' => 'Please fill all fields'], 400);
            }
            if ($data['password'] !== $data['password2']) {
                return response()->json(['error' => 'password does not match'], 400);
            }    
            if (strlen($data['password']) < 8) {
                return response()->json(['error' => 'Passwords minimal 8 character'], 400);
            }
            if (strlen($data['password']) < 8) {
                // return redirect('/register')->with('error', 'Passwords minimal 8 character');
                return response()->json(['error' => 'Passwords minimal 8 character'], 400);
            }
            $hashed = Hash::make($data['password'], [
                'rounds' => 12,
            ]);
            $user = User::find($data['id']);
            $user->password = $hashed;
            $user->save();

            return response()->json(['success' => 'data is updated'], 200);
        }
    }

    function changeUsername(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
           if (!$data['name'] ) {
            return response()->json(['error' => 'Please fill all fields'], 400);
            }

            if(strlen($data['name']) < 8){
                return response()->json([
                    'error'  => 'Nama harus berjumlah minimal 8 karakter'
                ], 400);
            }    
            $user = User::find(session()->get('id'));
            $user->name = $data['name'];
            $user->save();

            return response()->json(['success' => 'data is updated'], 200);
        }
    }

    
}
