<?php
 
namespace App\Http\Controllers;
 
class UserController extends Controller
{
    public function userprofile()
    {
        return view('userprofile');
    }
 
    public function about()
    {
        return view('about');
    }
}