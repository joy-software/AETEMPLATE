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
        $this->_users_group = usergroup::where('user_ID', '=', Auth::id())->where('statut','=', 'actif')->get();

        $_users_group2 = usergroup::where('user_ID', '=', Auth::id())->get();
        foreach ($_users_group2 as $_el){
            $this->_statut_group[''.$_el->group_ID.''] = $_el->statut;
        }

        foreach ($this->_users_group as $element){
            $this->_list_group[$this->_compteur] = group::where('id','=',$element['group_ID'])->first();
            $this->_id_list_group[$this->_compteur] = $this->_list_group[$this->_compteur]['id'];
            //$this->_statut_group[''.$this->_id_list_group[$this->_compteur].''] = $element->statut;
            $this->_compteur++;
        }


        /*foreach ($this->_users_group as $element){
            $this->_list_group[$this->_compteur] = group::where('id','=',$element['group_ID'])->first();
            $this->_id_list_group[$this->_compteur] = $this->_list_group[$this->_compteur]['id'];
            $this->_statut_group[''.$this->_id_list_group[$this->_compteur].''] = $element->statut;
            $this->_compteur++;
        }*/

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

        $group = group::find($id);

        $user_group = usergroup::where('group_ID','=',$id)->whereStatut("attente")->get();
        $users[]=null;
        $com = 0;


        foreach($user_group as $u_g){

            $users[$com] = User::find($u_g['user_ID']);
            $com++;
        }

        if($com == 0){
            //ça veut dire que la liste est vide $user_group est vide.
            $users = null;
        }
        //print_r ($users);

        return view('group.view_group',
            ['list_group'=> $this->_list_group,
                'group'=>$group,
                'users'=> $users
            ]);
    }

    //public function valid_adhesion_group($id_user, $id_group){
    public function valid_adhesion_group(Request $request){
        $id_user = null;
        $id_group = null;
        if($request->ajax()) {
            $id_user = $request->id_user;
            $id_group = $request->id_group;

        }

        $this->load_group();
        foreach ($this->_id_list_group as $id_gp ){
            if( ! in_array($id_group, $this->_id_list_group)){
                //il n'est pas dans ce groupe.
                print_r("cet utilisateur n'est pas de ce groupe");
                die;
            }

        }

        $usergroup = usergroup::where('user_ID','=',$id_user)->where('group_ID','=',$id_group)->get();

        if(! ( ($usergroup[0]->user_ID == $id_user ) && ($usergroup[0]->group_ID == $id_group) )){

            print_r("La clé user_id et group_id est incorrecte");
            die;
        }

        if($usergroup[0]->statut != "attente"){
            //Cet utilisateur n'est pas en attente de validation, mauvaise information.
            //return redirect()->route('search_group');
            print_r("cet utilisateur n'est pas en attente de validation dans le groupe");
            die;
        }

        $u_group = usergroup::findOrFail($usergroup[0]->id);
        $u_group->statut = "actif";
        $u_group->save();

        //Renvoyer le message pour dire que son statut a été changé.
        print_r("success");
        die;
    }
    /**
     * @param $id = id_du groupe où on veut les paramètres.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function member_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group]);
        }

        if(! in_array($id, $this->_id_list_group)){
            //Il n'est pas de ce groupe.
            return redirect()->back();
        }

        $id_users = DB::table('usergroup')->select('user_id')->where('group_ID','=',$id)->get();

        $tab_user_membre[]=null;
        $compt =0;
        foreach ($id_users as $el){

            $tab_user_membre[$compt]= DB::table('users')->find($el->user_id);
            $compt++;
        }
        $group = group::find($id);

        return view('group.member_group',
            [
               'users_group'=>$this->_users_group,
              'tab_user_membre'=>$tab_user_membre,
              'id_group'=>$id,
                'list_group'=>$this->_list_group,
                'name_group'=> $group->name
            ]);
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

    /***
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Function réservé uniquement aux administrateurs du groupe.
     */
    public function edit_group($id){
        $this->load_group();
        $this->verification_param($id);
        if($id==null){
            return redirect()->route('search_group');
        }

        if(Auth::user()->hasRole('admin_'.$id)){
            $group = group::find($id);
            //$group = DB::table('group')->whereId($id)->first();
            return view('group.edit_group',['list_group'=> $this->_list_group,'group'=>$group]);
        }
        else {
            return redirect()->route('search_group');
        }

        //return response()->download($pathToFile, $name, $headers); $name c'est le nom du fichier à afficher à l'utilisateur.
       // return view('group.edit_group',['list_group'=> $this->_list_group, 'group'=>$group]);
    }

    public function valid_edit_group(Request $request){

        $group = group::findOrFail($request->get('id'));
        $this->validate($request, [
            'name' => 'required|min:5|max:20',
            'description' => 'required|min:5|max:1000'
        ]);

        $input = $request->all();
        $group->fill($input)->save();
        Session::flash('message', 'le groupe '.$group->name.' a été modifié avec succès');
        return redirect()->route('search_group');

    }

    /***
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Fonction reservée uniquement aux administrateurs du groupe.
     */

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
            return redirect()->route('search_group');
        }


        //vérifions s'il n'est pas déjà inscrit dans le groupe.

        if($this->_id_list_group != null){
            if(in_array($id, $this->_id_list_group)){
                //il est déjà dans le groupe c'est un petit jongleur. on le fait la redirection.
                return redirect()->route('search_group');
            }
            else{
                $group = DB::table('group')->whereId($id)->first();
                return view('group.invitation_group',['list_group'=> $this->_list_group, 'group'=>$group]);
            }
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
        return redirect()->route('search_group');
    }

}
