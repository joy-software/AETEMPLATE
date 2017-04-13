<?php

namespace App\Http\Controllers;

use App\Events\GroupCreateEvent;
use App\group;
use App\Listeners\GroupCreateListener;
use App\usergroup;
use App\Http\Requests\groupRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class groupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('group.index');
    }

    public function create_group(){
        return view('group.create_group');
    }

    public function search_group(){
        return view('group.search_group');
    }

    public function post_create_group(groupRequest $request){

        $extension_accepted = array('png','jpeg');
        if($request->file("logo") == null){
            $extension = null;
            $chemin = 'logos/default.png';
        }
        else{

            $request->file('logo')->move('logos', $request->file('logo')->getClientOriginalName());
            $chemin = 'logos/'. $request->file('logo')->getClientOriginalName();
        }


        /*   if( $extension!=null && (! in_array($extension,$extension_accepted ))){
            return \Redirect::route('create_group')->with('error', 'l\'extension '.$extension.'n\'est pas acceptée');
        }*/

            $id= Auth::id();
            $group = group::create([
            'description'=> $request->get('description_group'),
            'name' =>$request->get('name'),
            'logo' => $chemin,
            ]);
        $group->users()->associate(Auth::user());
        $group->save();

            $group_id = $group->id;
        $usergroup = usergroup::create([
                'id_validator'=> $id,
                'statut'=>'actif',
                'notification'=>TRUE
            ]);
        /*'user_ID'=>$id,
                'group_ID'=>$group_id,*/
        $usergroup->users()->associate(Auth::user());
        $usergroup->group()->associate($group);
        $usergroup->save();
        //echo $group;
        //firing the event so that we can associate roles to the user
      //  event(new GroupCreateEvent($group));
       // $order = group::findOrFail($group->id);
       // dd($order);
        \Event::fire(new GroupCreateEvent( $group));

        return \Redirect::route('create_group')->with('message', 'Le groupe '.$group->name.' a été bien crée. ');

    }
}
