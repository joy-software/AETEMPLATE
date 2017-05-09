<?php
/**
 * Created by PhpStorm.
 * User: michelB
 * Date: 06/05/2017
 * Time: 10:31
 */

namespace App\Http\Controllers;

use App\Traits\GoogleAuthTrait;


class GoogleController extends Controller
{

    use GoogleAuthTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

}