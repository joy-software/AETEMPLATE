<?php

namespace App\Http\Controllers;

use App\group;
use App\User;
use App\usergroup;
use App\Http\Requests\groupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AnnuaireController;
class groupController extends Controller
{
   private $_list_group;
   private $_users_group;
   private $_compteur =0;

   public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Le but de cette fonction est de charger les valeurs afin d'empecher
     * d'aller dans la bd tout les temps pour chercher les informations.
     */

    public function load_group(){
        $this->_compteur = 0;
        $this->_list_group=null;
        $this->_users_group = null;

        $this->_users_group = usergroup::where('user_ID', '=', Auth::id())->get();

        foreach ($this->_users_group as $element){
            $this->_list_group[$this->_compteur] = group::where('id','=',$element->group_ID)->first();
            $this->_compteur++;
        }
    }

    /*
     * le but est de vérifier si l'indice compteur est à zéro.
     * Et dans ce cas il faut recharger la liste.
     */
    private function verification(){
        if($this->_compteur ==0){
            $this->load_group();
        }
    }

    /**
     * @param $id
     * il nous permettra de verifier que les paramètres renvoyés sont bon.
     */
    public function verification_param($id){
        //contenu à venir.
    }


    public function index(){
        $this->verification();

        return view('group.index',['list_group'=> $this->_list_group]);
    }

    public function create_group(){
        $this->verification();
        return view('group.create_group',['list_group'=> $this->_list_group]);
    }

    public function search_group(){
        $this->verification();
        return view('group.search_group',['list_group'=> $this->_list_group]);
    }

    public function post_create_group(groupRequest $request){

        //$extension_accepted = array('png','jpeg');
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

        $this->load_group(); // Pour actualiser la base de donnée.
        return \Redirect::route('create_group')->with(['message' => 'Le group '.$group->name.' a été bien crée.', 'list_group'=> $this->_list_group]);
        //return \Redirect::route('create_group')->with('message', 'Le group '.$group->name.' a été bien crée. ');

    }

    public function view_group($id){
        $this->verification();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.view_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function member_group($id){
        $this->verification();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }

        return view('group.member_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function ads_group($id){
        $this->verification();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.ads_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function event_group($id){
        $this->verification();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.event_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function ballot_group($id){
        $this->verification();
        $this->verification_param($id);
        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.ballot_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }


}
