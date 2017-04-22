<?php
namespace App\Http\Controllers;

use App\group;
use App\Notifications\AccountApproved;
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

        $notifications = $user->unreadnotifications()->count();
        return view('accueil',['user'=> $user->unreadnotifications()->paginate(6),
            'nbr_notif'=> $notifications,
            'nbr_ads_A'=>$nbr_ads,
            'nbr_event_A'=>$nbr_event,
            'nbr_mem_A'=>$nbr_mem,
            'nbr_meet_A'=>$nbr_meet,
            'user' => $user,
            'date'=> Carbon::now(),
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
        $notifications = $user->unreadnotifications()->count();
        return view('profile/index',['user'=> $user->unreadnotifications()->paginate(6),'nbr_notif'=> $notifications]);
    }

    public function tester(){
        return view('test/testIndex');
    }



}

