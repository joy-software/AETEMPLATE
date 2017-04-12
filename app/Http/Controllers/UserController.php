<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   public function editProfile(Request $request)
   {

        $user = Auth::user();
        $param = $request->only(['surname', 'name', 'phone', 'promotion', 'country', 'profession']);

        foreach ($param as $key => $value){

            $user->$key = $value;
        }

        $user->save();

        return redirect()->route('profile')->with(['success' => 'Modifications réussies']);
   }


   public function editCredential(Request $request)
   {

       $user = Auth::user();
       $param = $request->only(['old_password', 'email', 'new_password', 'password_confirmation']);

       $param['old_password'] = bcrypt($param['old_password']);
       $param['new_password'] = bcrypt($param['new_password']);
       $changed = false;

       if($user->password == $param['old_password']){

           if ($param['email'] != null){

               $changed = true;
               $user->email = $param['email'];
           }

           if($param['new_password'] != null){

               $changed = true;
               $user->password = $param['new_password'];
           }

           if($changed){

               $user->save();
               $message = 'Modifications réussies';
           }

       } else {

           $message = 'Mot de passe incorrecte';
       }


       return redirect()->route('profile')->with(['success' => $message . '/////' . $param['old_password'] . '/////' . $user->password]);

   }
}
