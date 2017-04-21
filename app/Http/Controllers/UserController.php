<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function editProfile(Request $request)
   {
      // echo "print de requestion <br>";
       //echo $request->file("photo");
       $request->file("photo")->move('logos', $request->get('photo'));

        //echo "déplacement avec succès";
        $user = Auth::user();

        $param = $request->only(['surname', 'name', 'phone', 'promotion', 'country', 'profession', 'sex', 'description']);

        $photo = $request->file('photo')->getClientOriginalName();


        foreach ($param as $key => $value){

            $user->$key = $value;
        }

        $user->save();

       $notifications = $user->unreadnotifications()->count();
        return redirect()->route('profile')->with(['success' => $photo]);
        //return redirect()->route('profile')->with(['success' => 'Modifications réussies','user'=> $user->unreadnotifications()->paginate(6),'nbr_notif'=> $notifications]);
   }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function editCredential(Request $request)
   {

       $user = Auth::user();

       $param = $request->only(['old_password', 'email', 'new_password', 'password_confirmation']);

       $changed = false;

       if(Hash::check($param['old_password'], $user->password)){

           if ($param['email'] != null && $param['email'] != ''){

               $changed = true;
               $user->email = $param['email'];
           }

           if($param['new_password'] != null && $param['new_password'] != ''){

               $changed = true;
               $param['new_password'] = Hash::make($param['new_password']);
               $user->password = $param['new_password'];
           }

           if($changed){

               $user->save();
               $message = 'Modifications réussies';
           }

       } else {

           $message = 'Mot de passe incorrecte';
       }


       $notifications = $user->unreadnotifications()->count();

       return redirect()->route('profile')->with(['success' => $message,'user'=> $user->unreadnotifications()->paginate(6),'nbr_notif'=> $notifications]);

   }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function notifications()
   {
       $user = Auth::user();
       $notifications = $user->unreadnotifications()->count();
       return view('layouts/index',['user' =>  $user,'nbr_notif'=> $notifications]);
   }

    /**
     * @return string
     */
    public function read_notifications()
    {
        $user = Auth::user();
        foreach ($user->unreadnotifications()->paginate(6)  as $notification) {
            $notification->markAsRead();
        }
        $notifications = $user->unreadnotifications()->count();
        $view  = View::make('layouts/Notifications',
            [
                'classIcon' => 'icon-bell-l',
                'numberNotification' => $notifications,
                'notifications' => $user->unreadnotifications()->paginate(6)
            ]);
        return $view->render();
    }

    /**
     * @return string
     */
    public function update_notifications()
    {
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        $view  = View::make('layouts/Notifications',
            [
                'classIcon' => 'icon-bell-l',
                'numberNotification' => $notifications,
                'notifications' => $user->unreadnotifications()->paginate(6)
            ]);
        return $view->render();
    }
}
