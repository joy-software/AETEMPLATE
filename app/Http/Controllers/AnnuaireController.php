<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnuaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $users = null;

    public function index()
    {
        $users =DB::table('users')->get();
       // $years = DB::table('users')->groupBy('promotion')->get();

        $years = $users;
        $this->users = $users;
        return view('annuaire/index', ['users'=> $users, 'nom'=> $years]);
    }


    public function search($annees, $profession, $pays){
        $users_filter = null;
        return view('annuaire/search')->with('users_search',$users_filter);
    }



}