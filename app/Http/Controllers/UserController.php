<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        if ($request->file('photo') != null) {

            $this->photoValidator($request->allFiles())->validate();
        }

        $user = Auth::user();

        $param = $request->only(['surname', 'name', 'phone', 'promotion', 'country', 'profession', 'sex', 'description']);

        foreach ($param as $key => $value){

            $user->$key = $value;
        }


       $extension = null;

       if ($request->file("photo") != null) {

           $chemin = null;

           $extension = strtolower($request->file('photo')->extension());

           if ($extension != 'png' && $extension != 'jpg' && $extension != 'jpeg') {

               $correctPhoto = false;

               if ($user->sex == 'M') {

                   $chemin = "users/default_gent_avatar.png";

               } else {

                   $chemin = "users/default_lady_avatar.png";
               }

           } else {

               $request->file('photo')->move('users', 'photo' . '___' . $user->name . '___' . $user->id . '.' . $extension);
               $chemin = '/users/'. 'photo' . '___' . $user->name . '___' . $user->id . '.' . $extension;
           }

           $user->photo = $chemin;
       }



       $user->save();

       $nbr_event = 0;
       $nbr_ads = 0;
       $nbr_mem = 0;

       foreach ($user->unreadNotifications() as $notification)
       {
           if($notification->type = 'App\Notifications\NewAnnouncement')
           {
               $nbr_ads++;
           }
           if($notification->type = 'App\Notifications\NewEvent')
           {
               $nbr_event++;
           }
           if($notification->type = 'App\Notifications\IncommingMember')
           {
               $nbr_mem++;
           }
       }
       /**End loading**/

       //$contributions = null;

       $notifications = $user->unreadnotifications()->count();

       return redirect()->back()->with(['success' => 'Modifications réussies',
           'user'=> $user->unreadnotifications()->paginate(6),
           'nbr_notif'=> $notifications,
           'nbr_ads'=>$nbr_ads,
           'nbr_event'=>$nbr_event,
           'nbr_mem'=>$nbr_mem]);
   }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function editCredential(Request $request)
   {
       $this->passwordValidator($request->all())->validate();

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

       $nbr_event = 0;
       $nbr_ads = 0;
       $nbr_mem = 0;

       foreach ($user->unreadNotifications() as $notification)
       {
           if($notification->type = 'App\Notifications\NewAnnouncement')
           {
               $nbr_ads++;
           }
           if($notification->type = 'App\Notifications\NewEvent')
           {
               $nbr_event++;
           }
           if($notification->type = 'App\Notifications\IncommingMember')
           {
               $nbr_mem++;
           }
       }
       /**End loading**/

       //$contributions = null;
       $notifications = $user->unreadnotifications()->count();

       return redirect()->route('profile')->with(['success' => $message,
           'user'=> $user->unreadnotifications()->paginate(6),
           'nbr_notif'=> $notifications,
           'nbr_ads'=>$nbr_ads,
           'nbr_event'=>$nbr_event,
           'nbr_mem'=>$nbr_mem]);

   }

    protected function photoValidator(array $data)
    {

        $validator = Validator::make($data,
            [
                'photo'               => 'mimes:jpg,jpeg,png|max:5000',
            ],
            [
                'photo.mimes'     => 'Les extensions d\'images acceptées sont jpg, jpeg et png',
                'photo.max'       => 'La taille de l\'image ne doit pas excéder 5 Mo',
            ]
        );

        return $validator;
    }

    protected function passwordValidator(array $data)
    {

        $validator = Validator::make($data,
            [
                'new_password' => 'min:6',
                'password_confirmation' => 'min:6|same:new_password',
            ],
            [
                'new_password.min'          => 'Le mot de passe doit contenir au moins 6 caractères',
                'password_confirmation.min'    => 'Le mot de passe doit contenir au moins 6 caractères',
                'password_confirmation.same'    => 'Ce champ est différent du mot de passe',
            ]
        );

        return $validator;
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
