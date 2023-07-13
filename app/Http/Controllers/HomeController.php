<?php

namespace App\Http\Controllers;
use App\Models\User;
use DB;
use auth;
use Helper;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $id=auth::id();  
        // $user_data=User::all();
         
        $fun= Helper::user_detail($id);
        $res=DB::table('users')->select('id','name','email','image');
        if(!$fun){
            $res->where('id',$id);
        }
        $user_data = $res->get();
        return view('home',compact('user_data'));
    }

    public function delete_user(Request $request)
    {
        $id=$request->id;
        $res=User::where('id',$id)->delete();


    }

    public function update_data_backend(Request $request)
    {
         $id=$request->id;
         $sql=DB::table('users')->select('id','name','email','image')->where('id',$id)->get();
         echo $sql;
    }
}
