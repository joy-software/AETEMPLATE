<?php

namespace App\Http\Controllers;

use App\group;
use App\Role;
use App\User;
use App\usergroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Redirect;


class remerciementController extends Controller
{

    public function index (){

        return view('remerciement.index');

    }

}