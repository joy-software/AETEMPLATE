<?php
namespace App\Http\Controllers;

use App\contribution;
use App\group;
use App\motif;
use App\Notifications\AccountApproved;
use App\period;
use App\usergroup;
use Auth;
use App\Notifications\incomingUser;
use Carbon\Carbon;
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
        /**Loading data for the user**/
        $user = Auth::user();
        //$user->notify(new AccountApproved());
      //  echo $user->id;
        $users_groups = usergroup::select('group_ID')->where('user_ID', '=', Auth::id())->where('statut','=', 'actif')->get();
        $nbr_event = 0;
        $nbr_ads = 0;
        $nbr_mem = 0;
        $nbr_meet = 0;
        $nbr_ads_group = null;
        $nbr_event_group = null;
        $nbr_mem_group = null;
        $name_group = null;

        foreach ($users_groups as $users_group)
        {
            $nbr_ads_group[$users_group->group_ID] = 0;
            $nbr_event_group[$users_group->group_ID] = 0;
            $nbr_mem_group[$users_group->group_ID] = 0;
            $group = group::findOrFail($users_group->group_ID);
            $name_group[$users_group->group_ID] = $group->name;
        }

        foreach ($user->unreadNotifications() as $notification)
        {
            if($notification->type = 'App\Notifications\NewAnnouncement')
            {
                $nbr_ads_group[$notification->data->id_group] = $nbr_ads_group[$notification->data->id_group] + 1;
                $nbr_ads++;
            }
            if($notification->type = 'App\Notifications\NewEvent')
            {
                $nbr_event_group[$notification->data->id_group] = $nbr_event_group[$notification->data->id_group] + 1;
                $nbr_event++;
            }
            if($notification->type = 'App\Notifications\IncommingMember')
            {
                $nbr_mem_group[$notification->data->id_group] = $nbr_mem_group[$notification->data->id_group] + 1;
                $nbr_mem++;
            }
        }
        /**End loading**/
        /***Loading data for accounting***/
        $now = Carbon::now();
        $period_month = $now->month;
        $period_year = $now->year;
        $period_id = period::select('id')->where('month','=',$period_month)
            ->where('year','=',$period_year)->get()->first();

        $contributions = array();
        $amount = 0;
        $compteur = 0;

      if($period_id != null)
      {
          $contribut = contribution::where('period_ID','=',$period_id->id)->get();
          foreach ($contribut as $contrib)
          {
              $motif = motif::find($contrib->motif_ID);
              // $contributions[$compteur]['motif'] = ;
              // $contributions[$compteur]['amount'] = $contrib->amount;

              //'$contribution[\'motif\']}}' .'=>'. '$contribution[\'amount\']'
              $contributions[$contrib->amount] = $motif->reason;
              if($compteur == 0)
              {
                  $amount = $contrib->amount;
              }
              $compteur++;
          }
      }
      else
      {
          $contribut = null;
      }



        /***End Loading ***/
        $contributions = null;

        $notifications = $user->unreadnotifications()->count();
        return view('accueil',['user'=> $user->unreadnotifications()->paginate(6),
            'nbr_notif'=> $notifications,
            'nbr_ads_A'=>$nbr_ads,
            'nbr_event_A'=>$nbr_event,
            'nbr_mem_A'=>$nbr_mem,
            'nbr_meet_A'=>$nbr_meet,
            'avatar' => $user,
            'date'=> Carbon::now(),
            'contributions' => $contributions,
            'amount' => $amount,
            'user_groups' =>$users_groups,
            'name_groups' => $name_group,
            'nbr_ads_group'=>$nbr_ads_group,
            'nbr_event_group'=>$nbr_event_group,
            'nbr_mem_group'=>$nbr_mem_group]);
    }

    public function auth()
    {
        return view('auth/lagin');
    }
    public function profile(Request $request){
        $user = Auth::user();
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

        return view('profile/index',[
            'user'=> $user->unreadnotifications()->paginate(6),
            'nbr_notif'=> $notifications,
            'nbr_ads'=>$nbr_ads,
            'nbr_event'=>$nbr_event,
            'nbr_mem'=>$nbr_mem]);
    }

    public function tester(){
        return view('test/playVideo');
    }



}

