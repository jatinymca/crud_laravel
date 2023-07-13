<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use auth;
use Helper;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;

class UserController extends Controller
{
   
    public function update_data_backend(Request $request)
    {
         $id=$request->id;
         $sql=DB::table('users')->select('id','name','email','image')->where('id',$id)->get();
         echo $sql;
    }
}