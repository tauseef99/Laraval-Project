<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
class ImageController extends Controller
{

    public function index($id){
        $images = DB::table('users')->get();        
        return view('user',['images'=>$images]);
    }
    public function store(Request $request)
    {
        // Validate the request
        // $request->validate([
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        //     'name' => 'required|string|max:255', // Validate name
        //     'email' => 'required|string|email|max:255|unique:users', // Validate email
        //     'password' => 'required|string|min:8', // Validate password
        // ]);
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $name); 
            
            $userData['image'] = $name; 
        }

        
        DB::table('users')->insert($userData);
        return redirect("/")->with('success', 'User registered successfully.');
    }
}
