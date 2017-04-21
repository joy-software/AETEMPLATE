<?php
namespace App\Http\Controllers;

use App\Notifications\AccountApproved;
use Auth;
use App\Notifications\incomingUser;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    protected $redirectTo = '/acceuil';
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
        $user->notify(new AccountApproved());
      //  echo $user->id;
        $notifications = $user->unreadnotifications()->count();
        return view('accueil',['user'=> $user->unreadnotifications()->paginate(6),'nbr_notif'=> $notifications]);
    }
    public function auth()
    {
        return view('auth/lagin');
    }
    public function profile(Request $request){
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        return view('profile/index',['user'=> $user->unreadnotifications()->paginate(6),'nbr_notif'=> $notifications]);
    }

    public function tester(){
        return view('test/testIndex');
    }

    public function redirect()
    {
        return $this->redirect();
    }


}

