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
        return view('accueil');
    }
    public function auth()
    {
        return view('auth/lagin');
    }
    public function profile(Request $request){
        return view('profile/index');
    }


}

