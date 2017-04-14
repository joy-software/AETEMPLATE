<?php

namespace App\Http\Controllers;

use App\Events\GroupCreateEvent;
use App\group;
use App\Listeners\GroupCreateListener;
use App\Notifications\IncomingMember;
use App\User;
use App\usergroup;
use App\Http\Requests\groupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Role;

class groupController extends Controller
{
   private $_list_group; //c'est la liste des groupes auxquelles j'ai souscrit.
   private $_users_group; // c'est la liste des users_groups qui est != des groupes.
   private $_compteur =0; // c'est mon fidèle compteur pour me rassurer des updates.
   private $_all_group; //Liste de tous les groupes présent dans la bd.
   private $_id_list_group; //c'est le tableau contenant les id des groupes auxquels j'appartiens.


   private $_statut_group; // c'est un tableau clé valeur. clé = id_groupe, valeur = statut_dans_le_groupe.

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
        $this->_id_list_group = null;
        $this->_statut_group = null;
        $this->_list_group=null;
        $this->_users_group = null;
        $this->_all_group = null;


        $this->_all_group = DB::table('group')->get();
        $this->_users_group = usergroup::where('user_ID', '=', Auth::id())->get();



        foreach ($this->_users_group as $element){
            $this->_list_group[$this->_compteur] = group::where('id','=',$element['group_ID'])->first();
            $this->_id_list_group[$this->_compteur] = $this->_list_group[$this->_compteur]['id'];
            $this->_statut_group[''.$this->_id_list_group[$this->_compteur].''] = $element->statut;
            $this->_compteur++;
        }

    }

    /*
     * le but est de vérifier si l'indice compteur est à zéro.
     * Et dans ce cas il faut recharger la liste.
     */
    private function verification(){
        //if($this->_compteur ==0){
       // if($this->_list_group== null){
         //   echo "la liste des groupe est pas null";

           // $this->load_group();

        //}
    }

    /**
     * @param $id
     * il nous permettra de verifier que les paramètres renvoyés sont bon.
     */
    public function verification_param($id){
        //contenu à venir.
    }

    public function index(){
        $this->load_group();

        return view('group.index',['list_group'=> $this->_list_group]);
    }

    //elle renvoie la page de création d'un groupe.
    public function create_group(){
        $this->load_group();
        return view('group.create_group',['list_group'=> $this->_list_group]);
    }

    public function search_group(){
        $this->load_group();

        return view('group.search_group',
            ['list_group'=> $this->_list_group,
             'all_group'=>$this->_all_group,
             'id_list_group'=>$this->_id_list_group,
             'statut_group'=>$this->_statut_group
            ]);

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
        \Event::fire(new GroupCreateEvent( $group));
        $this->load_group(); // Pour actualiser la base de donnée.
        return \Redirect::route('create_group')->with(['message' => 'Le group '.$group->name.' a été bien crée.', 'list_group'=> $this->_list_group]);
        //return \Redirect::route('create_group')->with('message', 'Le group '.$group->name.' a été bien crée. ');

    }

    public function view_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.view_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function member_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
       // $user_group_i = DB::table('usergroup')
       //     ->select('usergroup.')

        return view('group.member_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function ads_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.ads_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function event_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.event_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function ballot_group($id){
        $this->load_group();
        $this->verification_param($id);
        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }
        return view('group.ballot_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function edit_group($id){
        $this->load_group();
        $this->verification_param($id);
        if($id==null){
            $this->search_group();
        }
        //return response()->download($pathToFile, $name, $headers); $name c'est le nom du fichier à afficher à l'utilisateur.
        return view('group.edit_group',['list_group'=> $this->_list_group, 'id'=>$id]);
    }

    public function del_group($id){
        $this->load_group();
        $this->verification_param($id);
        if($id==null){
            $this->search_group();
        }

        if(Auth::user()->hasRole('admin_'.$id)){
            $group = DB::table('group')->whereId($id)->first();
            return view('group.del_group',['list_group'=> $this->_list_group,'group'=>$group]);
        }
        else {
            $this->search_group();
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * c'est la méthode qui est appelé lorsqu'il valide definitivement la suppression du groupe.
     * c'est la post method.
     */
    public function valid_del_group(Request $request){
        $id_group = intval($request->get('id_group'));
        $this->load_group();
        $this->verification_param($id_group);
        $group_associate = group::find($id_group);
        $nom_groupe = $group_associate->name;

        $id_users = DB::table('usergroup')->select('id')->where('group_ID','=',$id_group)->get();

        foreach ($id_users as $el){
            DB::table('usergroup')->delete($el->id);
        }

        $role  = DB::table('roles')->where('name','=','admin_'.$id_group)->get();
        $role = $role[0];

        DB::table('role_user')->where('role_id', $role->id)->delete();
        DB::table('permission_role')->where('role_id', $role->id)->delete();

        $group_associate->delete();

        $this->load_group();

        Session::flash('message', 'Le groupe '.$nom_groupe .'a été supprimé avec succès');

        return redirect()->route('search_group');
    }

    public function invitation_group($id){
        $this->load_group();
        $this->verification_param($id);
        if($id==null){
            $this->search_group();
        }

        //vérifions s'il n'est pas déjà inscrit dans le groupe.
        if(in_array($id, $this->_id_list_group)){
            //il est déjà dans le groupe c'est un petit jongleur. on le fait la redirection.
            $this->view_group($id);
        }
        else{
            $group = DB::table('group')->whereId($id)->first();
            return view('group.invitation_group',['list_group'=> $this->_list_group, 'group'=>$group]);
        }
    }

    public function valid_invitation_group(Request $request){

        $id_group = intval($request->get('id_group'));
        $this->verification();
        $this->verification_param($id_group);
        $usergroup = usergroup::create([
            'statut'=>'attente',
            'notification'=>TRUE
        ]);
        //$group_associate->users()->associate(Auth::user());
        $group_associate = group::find($id_group);

        $usergroup->users()->associate(Auth::user());
        $usergroup->group()->associate($group_associate);
        $usergroup->save();

        /**Envoie de la notification par mail**/
        $id_users = usergroup::select('user_id')->where('group_id', '=',$id_group)->where('user_id','!=',Auth::id())->get();
        foreach ($id_users as $id_user)
        {
            $user = User::findorfail($id_user->user_id);
            $user->notify(new IncomingMember(Auth::user(), $group_associate));
        }
        /**Fin de l'envoie**/
        $this->load_group();
        Session::flash('message', 'Votre demande d\'adhésion a été envoyé avec succès. En attente de validation de votre demande par un membre de ce groupe');
        return view('group.search_group',['list_group'=> $this->_list_group]);
    }

}
