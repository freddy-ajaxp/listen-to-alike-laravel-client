<?php

namespace App\Http\Controllers;

use App\Link;
use App\Link_platform;
use App\List_platform;
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
            // return response()->json(['error' => 'Please complete the registration form'], 400);
            return redirect('/register')->with('error', 'Please complete the registration form');
        }
        // print_r('lewat');
        // exit();
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
            // return response()->json(['success' => 'Your Account Is Succesfully Created', 
            // 'data' => 'success'], 200);
        }
    }

    function logout(Request $request)
    {
        $request->session()->forget('email');
        $request->session()->forget('id');
        $request->session()->forget('admin');
        return redirect("/login");
    }
}
