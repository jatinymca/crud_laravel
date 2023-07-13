<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use DB;

class Helper
{
     public static function user_detail($id)
    {
       
       $res=DB::table('users')->select('id','name','email','role_type')->where('id',$id)->value('role_type');
       if($res==1){

         return true;
       }
       else{
         return false;
       }
    }
}