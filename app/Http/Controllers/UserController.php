<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        return view('user-register');
    }
    public function store(Request $request){
        $formData=$request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        User::create($formData);
        return redirect('/');
    }

    public function index(Request $request){

        // Retrieve user details from session
        $user = $request->session()->get('user');

        // Access user details
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        // Pass user details to the view
        return view('user-dashboard', compact('userId','userName', 'userEmail'));
    }
    public function show(Request $request){
         // Retrieve user details from session
         $user = $request->session()->get('user');

         // Access user details
         $userId = $user->id;
         $userName = $user->name;
         $userEmail = $user->email;
 
         $products = Product::with('user')->get();
  
         // Pass user details to the view
         return view('products', compact('userId', 'userName', 'userEmail', 'products'));
    }

}
