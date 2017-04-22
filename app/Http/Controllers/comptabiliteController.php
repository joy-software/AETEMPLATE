<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\period;

use Auth;

class comptabiliteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //$periodes =  period::orderBy('created_at','desc')->get;
        $tab_mois = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

        $count_period= period::get()->count();
        if($count_period > 5){
            $periodes = \period::orderBy('created_at','desc')
                ->take(5);
        }
        else if($count_period == 0){
            $periodes = null;
            }
        else{
            $periodes = period::orderBy('created_at','desc')
                ->get();
        }

        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        return view('comptabilite.index',[
            'user' =>  $user,
            'nbr_notif'=> $notifications,
            'periodes'=> $periodes,
            'tab_mois'=>$tab_mois
            ]);
    }
}
