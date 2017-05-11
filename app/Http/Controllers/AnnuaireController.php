<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;

class AnnuaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        session(['menu' => 'annuaire']);
        $members =DB::table('users')->where('id','!=',1)->get();
       // $years = DB::table('users')->groupBy('promotion')->get();

        //$years = $users;
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        return view('annuaire/index', ['members'=> $members,'user'=> $user->unreadnotifications,'nbr_notif' => $notifications]);
    }



}
