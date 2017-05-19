<?php

namespace App\Listeners;

use App\period;
use App\usergroup;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Auth;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $groups = array();
        if (!session()->has('group')) {
            session(['group' =>  $groups]);
        }
        if (!session()->has('role_admin')) {
            session(['role_admin'  => "false"]);
        }
        if (!session()->has('menu')) {
            session(['menu'  => "acceuil"]);
        }
        if (!session()->has('role_compt')) {
            session(['role_compt'  => "false"]);
        }


        $compteur = 0;
        $user = Auth::user();
        $users_group = usergroup::where('user_ID', '=', Auth::id())->where('statut','=', 'actif')->get();

        if($user->hasRole('comptable'))
        {
            session(['role_compt'  => "true"]);
        }

        foreach ($users_group as $element){
            if($user->hasRole('admin_'.$element['group_ID']))
            {
                session(['role_admin' =>"true"]);
            }
            if(!array_has(session('group'),$compteur))
            {
                session()->push('group',$element['group_ID']);
            }
            $compteur++;
        }

        $now = Carbon::now();
        $period_month = $now->month;
        $period_year = $now->year;
        $period_count = period::select('id')->where('month','=',$period_month)
            ->where('year','=',$period_year)->get()->count();
        if($period_count == 0)
        {
            $period = new period([
               'month' => $period_month,
                'year' => $period_year
            ]);
            $period->save();
        }
    }
}
