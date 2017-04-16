<?php
namespace App\Http\Controllers;

use Auth;
use App\Notifications\incomingUser;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //$user->notify(new incomingUser());

        $notifications = $user->unreadNotifications;
        return view('accueil',['notifications'=> $notifications,'nbr_notif'=> count($notifications)]);
    }
    public function auth()
    {
        return view('auth/lagin');
    }
    public function profile(Request $request){
        return view('profile/index');
    }

    public function tester(){
        return view('test/testIndex');
    }


}

