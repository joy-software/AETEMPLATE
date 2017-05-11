<?php

namespace App\Http\Controllers;

use App\ads;
use App\ads_has_files;
use App\Events\GroupCreateEvent;
use App\files;
use App\group;

use App\Notifications\IncomingMember;
use App\Notifications\InformOthersInvitationAccepted;
use App\Notifications\InvitationAccepted;
use App\Notifications\NewAnnouncement;
use App\Notifications\NewEvent;
use App\User;
use App\usergroup;
use Carbon\Carbon;
use Validator;
use App\Http\Requests\groupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Role;

class groupController extends Controller
{
   public $_list_group; //c'est la liste des groupes auxquelles j'ai souscrit.
   public $_users_group; // c'est la liste des users_groups qui est != des groupes.
   public $_compteur =0; // c'est mon fidèle compteur pour me rassurer des updates.
   public $_all_group; //Liste de tous les groupes présent dans la bd.
   public $_id_list_group; //c'est le tableau contenant les id des groupes auxquels j'appartiens.

   public $_statut_group; // c'est un tableau clé valeur. clé = id_groupe, valeur = statut_dans_le_groupe.

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

      /*  $groups = array();
        if (!session()->has('group')) {
            session(['group' =>  $groups]);
        }//*/


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

           /* if(!array_has(session('group'),$this->_compteur))
            {
               session()->push('group',$element['group_ID']);
            }//*/
            $this->_compteur++;
            session(['menu' => 'groupe']);

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
        $user = Auth::user();
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


        $notifications = $user->unreadnotifications()->count();

        return view('group.index',['list_group'=> $this->_list_group,
            'user'=> $user->unreadnotifications,
            'nbr_notif'=> $notifications,
            'nbr_ads_A'=>$nbr_ads,
            'nbr_event_A'=>$nbr_event,
            'nbr_mem_A'=>$nbr_mem,
            'nbr_meet_A'=>$nbr_meet,
            'avatar' => $user,
            'date'=> Carbon::now(),
            'user_groups' =>$users_groups,
            'name_groups' => $name_group,
            'nbr_ads_group'=>$nbr_ads_group,
            'nbr_event_group'=>$nbr_event_group,
            'nbr_mem_group'=>$nbr_mem_group]);
    }

    //elle renvoie la page de création d'un groupe.
    public function create_group(){
        $this->load_group();
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        return view('group.create_group',['list_group'=> $this->_list_group,'user'=> $user->unreadnotifications,'nbr_notif'=> $notifications]);
    }

    public function search_group(){
        $this->load_group();
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        return view('group.search_group',
            ['list_group'=> $this->_list_group,
             'all_group'=>$this->_all_group,
             'id_list_group'=>$this->_id_list_group,
             'statut_group'=>$this->_statut_group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications
            ]);

    }

    public function post_create_group(groupRequest $request){

        $id= Auth::id();
        //$extension_accepted = array('png','jpeg');
        if($request->file("logo") == null){
            $extension = null;
            $chemin = 'default.png';
        }
        else{

            $fullName = $request->file('logo')->getClientOriginalName();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $onlyName = explode('.'.$extension,$fullName);
            $request->file('logo')->move('logos', $onlyName[0].'_'.$id.'.'.$extension);
            $chemin = $onlyName[0].'_'.$id.'.'.$extension;
        }


            $group = group::create([
            'description'=> trim($request->get('description_group')),
            'name' =>trim($request->get('name')),
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

        /**Action sous marine**/
        \Event::fire(new GroupCreateEvent( $group));
        if(!array_has(session('group'),count(session('group'))))
        {
            session()->push('group',$group->id);
        }//*/
        /**Fin acion Sous Marine**/

        $this->load_group(); // Pour actualiser la base de donnée.
        return \Redirect::route('create_group')->with(['message' => 'Le group '.$group->name.' a été bien crée.', 'list_group'=> $this->_list_group]);
        //return \Redirect::route('create_group')->with('message', 'Le group '.$group->name.' a été bien crée. ');

    }

    public function view_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            $user = Auth::user();
            $notifications = $user->unreadnotifications()->count();
            return view('group.index',['list_group'=> $this->_list_group,'user'=> $user->unreadnotifications,'nbr_notif'=> $notifications]);
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
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();

        /*
         * Chargement des 5 premières annonces et évènements.
         */
        $ads = null;
        $events = null;

        $count_ads = ads::where('type','=','annonce')
                 ->where('group_ID','=',$id)->count();

        if($count_ads > 5){
            $ads = ads::orderBy('created_at','desc')
                ->where('type','=', 'annonce')
                ->where('group_ID','=',$id)->take(5)->get();
        }
        else{
            $ads = ads::orderBy('created_at','desc')
                ->where('type','=', 'annonce')
                ->where('group_ID','=',$id)->get();
        }

        $count_events = ads::where('type','=','evenement')
            ->where('group_ID','=',$id)->count();

        if($count_events > 5){
            $events = ads::orderBy('created_at','desc')
                ->where('type','=', 'evenement')
                ->where('group_ID','=',$id)->take(5)->get();
        }
        else{
            $events = ads::orderBy('created_at','desc')
                ->where('type','=', 'evenement')
                ->where('group_ID','=',$id)->get();
        }

        $tab_ads_final = null;
        $tab_events_final = null;
        $tab_users= null;

        if($count_ads != 0){

            //for($i = 0; $i< $count_ads; $i++){
            foreach($ads as  $ad){

                $tab_users[''.$ad['id'].''] = User::find($ad['user_ID']);

               $ad_h_file = ads_has_files::where('ads_ID','=', $ad['id'])->get();

               if(count($ad_h_file)){
                   //echo "id = ".$ads;
                   foreach($ad_h_file as $el){
                       $file = files::findOrFail($el->files_ID);
                       $tab_ads_final[''.$ad['id'].''] =
                           (!isset($tab_ads_final[''.$ad['id'].'']) && empty($tab_ads_final[''.$ad['id'].'']))
                               ? $file->url : $tab_ads_final[''.$ad['id'].''] . '|' .$file->url;

                   }
               }else{
                   $tab_ads_final["".$ad['id'].""] = null;
               }
              // echo 'fin tour';
            }
        }else{
            $ads = null;
        }

        if($count_events != 0){
            //for($i = 0; $i< $count_events; $i++){
            foreach($events as $event){

                $tab_users[''.$event['id'].''] = User::find($event['user_ID']);

                $ad_h_file = ads_has_files::where('ads_ID','=', $event['id'])->get();
                if(count($ad_h_file)){
                    foreach($ad_h_file as $el){
                        $file = files::findOrFail($el->files_ID);

                        $tab_events_final[''.$event['id'].''] =
                            (!isset($tab_events_final[''.$event['id'].'']) && empty($tab_events_final[''.$event['id'].'']))
                                ? $file->url : $tab_events_final[''.$event['id'].''] . '|' .$file->url;

                        //$tab_events_final["".$events[$i]['id'] .""] .= "|".$file->url;
                    }
                }else{
                    $tab_events_final["".$event['id'] .""] = null;
                }
            }
        }
        else{
            $events = null;
        }




        return view('group.view_group',
            ['list_group'=> $this->_list_group,
                'group'=>$group,
                'users'=> $users,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications,
                'ads'=>$ads,
                'events'=>$events,
                'tab_events_final'=>$tab_events_final,
                'tab_ads_final'=>$tab_ads_final,
                'tab_users'=>$tab_users
            ]);
    }

    public function meeting_group($id){
        $this->load_group();
        $this->verification_param($id);

        if($id==null){
            $user = Auth::user();
            $notifications = $user->unreadnotifications()->count();
            return view('group.index',['list_group'=> $this->_list_group,'user'=> $user->unreadnotifications,'nbr_notif'=> $notifications]);
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
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();

        /*
         * Chargement des 5 premières annonces et évènements.
         */
        $ads = null;
        $events = null;

        $count_ads = ads::where('type','=','annonce')
            ->where('group_ID','=',$id)->count();

        if($count_ads > 5){
            $ads = ads::orderBy('created_at','desc')
                ->where('type','=', 'annonce')
                ->where('group_ID','=',$id)->take(5)->get();
        }
        else{
            $ads = ads::orderBy('created_at','desc')
                ->where('type','=', 'annonce')
                ->where('group_ID','=',$id)->get();
        }

        $count_events = ads::where('type','=','evenement')
            ->where('group_ID','=',$id)->count();

        if($count_events > 5){
            $events = ads::orderBy('created_at','desc')
                ->where('type','=', 'evenement')
                ->where('group_ID','=',$id)->take(5)->get();
        }
        else{
            $events = ads::orderBy('created_at','desc')
                ->where('type','=', 'evenement')
                ->where('group_ID','=',$id)->get();
        }

        $tab_ads_final = null;
        $tab_events_final = null;
        $tab_users= null;

        if($count_ads != 0){

            //for($i = 0; $i< $count_ads; $i++){
            foreach($ads as  $ad){

                $tab_users[''.$ad['id'].''] = User::find($ad['user_ID']);

                $ad_h_file = ads_has_files::where('ads_ID','=', $ad['id'])->get();

                if(count($ad_h_file)){
                    //echo "id = ".$ads;
                    foreach($ad_h_file as $el){
                        $file = files::findOrFail($el->files_ID);
                        $tab_ads_final[''.$ad['id'].''] =
                            (!isset($tab_ads_final[''.$ad['id'].'']) && empty($tab_ads_final[''.$ad['id'].'']))
                                ? $file->url : $tab_ads_final[''.$ad['id'].''] . '|' .$file->url;

                    }
                }else{
                    $tab_ads_final["".$ad['id'].""] = null;
                }
                // echo 'fin tour';
            }
        }else{
            $ads = null;
        }

        if($count_events != 0){
            //for($i = 0; $i< $count_events; $i++){
            foreach($events as $event){

                $tab_users[''.$event['id'].''] = User::find($event['user_ID']);

                $ad_h_file = ads_has_files::where('ads_ID','=', $event['id'])->get();
                if(count($ad_h_file)){
                    foreach($ad_h_file as $el){
                        $file = files::findOrFail($el->files_ID);

                        $tab_events_final[''.$event['id'].''] =
                            (!isset($tab_events_final[''.$event['id'].'']) && empty($tab_events_final[''.$event['id'].'']))
                                ? $file->url : $tab_events_final[''.$event['id'].''] . '|' .$file->url;

                        //$tab_events_final["".$events[$i]['id'] .""] .= "|".$file->url;
                    }
                }else{
                    $tab_events_final["".$event['id'] .""] = null;
                }
            }
        }
        else{
            $events = null;
        }




        return view('group.view_group',
            ['list_group'=> $this->_list_group,
                'group'=>$group,
                'users'=> $users,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications,
                'ads'=>$ads,
                'events'=>$events,
                'tab_events_final'=>$tab_events_final,
                'tab_ads_final'=>$tab_ads_final,
                'tab_users'=>$tab_users
            ]);
    }

   // public function valid_adhesion_group($id_user, $id_group){
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

                return response()->json([
                    'type'=>'error',
                    'message'=>"cet utilisateur n'est pas de ce groupe"
                    ]);
                //die;
            }

        }

        $usergroup = usergroup::where('user_ID','=',$id_user)->where('group_ID','=',$id_group)->get();

        if(! ( ($usergroup[0]->user_ID == $id_user ) && ($usergroup[0]->group_ID == $id_group) )){
            //print_r( 'incorrect');
            return response()->json([
                'type'=>'error',
                'message'=>"Les données de l'utilisateur et du groupe sont incorrectes."
            ]);

        }

        if($usergroup[0]->statut != "attente"){
            return response()->json([
                'type'=>'error',
                'message'=>"Cet utilisateur n'est pas en attente de validation dans le groupe."
            ]);

            //die;
        }

        $u_group = usergroup::findOrFail($usergroup[0]->id);
        $u_group->statut = "actif";
        $u_group->id_validator = Auth::id();
        $u_group->save();
       // print_r( 'tout est bien qui finit bien');
        //Renvoyer le message pour dire que son statut a été changé.


        /**Envoie de la notification par mail**/
        $sender = User::find($id_user);
        if($id_group == 1)
        {
            $sender->statut = "actif";
            $sender->save();
        }
        $group_associate = group::find($id_group);
        //notification par mail
        $validator = Auth::user();

        $sender->notify(new InvitationAccepted($validator,$group_associate,$sender));

        //notifications aux autres utilisateurs du groupe
        $id_users = usergroup::select('user_id')->where('group_id', '=',$id_group)
            ->where('user_id','!=',Auth::id())->where('notification','=',1)->get();

        foreach ($id_users as $id_user)
        {
            $user = User::findorfail($id_user->user_id);
            $user->notify(new InformOthersInvitationAccepted($sender, $group_associate));
        }
        /**Fin de l'envoie**/

        return response()->json([
            'type'=>'success',
            'message'=>"La demande a été validé avec succès."
        ]);
    }

    public function del_adhesion_group(Request $request){
        $id_user = null;
        $id_group = null;
        if($request->ajax()) {
            $id_user = $request->id_user;
            $id_group = $request->id_group;
        }

        //$this->load_group();

        $this->load_group();
        foreach ($this->_id_list_group as $id_gp ){
            if( ! in_array($id_group, $this->_id_list_group)){
                return response()->json([
                    'type'=>'error',
                    'message'=>"cet utilisateur n'est pas de ce groupe"
                ]);

            }

        }

        $usergroup = usergroup::where('user_ID','=',$id_user)->where('group_ID','=',$id_group)->get();

        if(! ( ($usergroup[0]->user_ID == $id_user ) && ($usergroup[0]->group_ID == $id_group) )){
            //print_r( 'incorrect');
            return response()->json([
                'type'=>'error',
                'message'=>"Les données de l'utilisateur et du groupe sont incorrectes."
            ]);

        }

        if(!(Auth::user()->hasRole('admin_'.$id_group))){
            return response()->json([
                'type'=>'error',
                'message'=> "Vous n'êtes pas administrateur de ce groupe. Vous n'avez pas le droit de supprimer cette demande"
            ]);
        }


        $u_group = usergroup::findOrFail($usergroup[0]->id);
        $u_group->delete();
        return response()->json([
            'type'=>'success',
            'message'=>"La suppression a été effectué avec succès."
        ]);
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

        $id_users = DB::table('usergroup')->select('user_id')->where('group_ID','=',$id)->where('user_id','!=',1)->get();

        $tab_user_membre[]=null;
        $compt =0;
        foreach ($id_users as $el){

            $tab_user_membre[$compt]= DB::table('users')->find($el->user_id);
            $compt++;
        }
        $group = group::find($id);
        $group->description = trim($group->description);
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        return view('group.member_group',
            [
               'users_group'=>$this->_users_group,
              'tab_user_membre'=>$tab_user_membre,
              'id_group'=>$id,
                'list_group'=>$this->_list_group,
                'name_group'=> $group->name,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications,
                'group'=>$group
            ]);
    }


    public function ads_group($id){
        $this->load_group();
        $this->verification_param($id);
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();


        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group, 'user'=> $user->unreadnotifications,'nbr_notif'=> $notifications]);
        }

        $ads = ads::orderBy('created_at','desc')
                ->where('archiving','=',false)
                ->where('group_ID','=', $id)
                ->where('type','=', "annonce")
                ->paginate(5);

        if(count($ads) == 0){
            $ads = null;
        }

        $tab_ads_final = null;
        $tab_users= null;

        if($ads != null){

            //for($i = 0; $i< $count_ads; $i++){
            foreach($ads as  $ad){
                $tab_users[''.$ad['id'].''] = User::find($ad['user_ID']);

                $ad_h_file = ads_has_files::where('ads_ID','=', $ad['id'])->get();

                if(count($ad_h_file)){
                    //echo "id = ".$ads;
                    foreach($ad_h_file as $el){
                        $file = files::findOrFail($el->files_ID);
                        $tab_ads_final[''.$ad['id'].''] =
                            (!isset($tab_ads_final[''.$ad['id'].'']) && empty($tab_ads_final[''.$ad['id'].'']))
                                ? $file->url : $tab_ads_final[''.$ad['id'].''] . '|' .$file->url;

                    }
                }else{
                    $tab_ads_final["".$ad['id'].""] = null;
                }
                // echo 'fin tour';
            }
        }

        $group = group::findOrFail($id);
        return view('group.ads_group',
            ['list_group'=> $this->_list_group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications,
                'group'=>$group,
                'tab_ads_final'=>$tab_ads_final,
                'tab_users' => $tab_users,
                'ads'=>$ads
            ]);
    }


    public function post_ads(Request $request){
        $messages = [
            'description.required' => "vous devez donner une description à l'annonce",
            'description.min'=>'votre annonce doit avoir minimum 10 caractères',
            'description.max'=>'votre annonce doit avoir maximum 1000 caractères',
            'file1.mimes'=>'Les extensions acceptées sont jpeg,png,jpg,gif,svg,pdf,docx,doc,xlsx,ppt,txt,mp3',
            'file2.mimes'=>'Les extensions acceptées sont jpeg,png,jpg,gif,svg,pdf,docx,doc,xlsx,ppt,txt,mp3',
            'file3.mimes'=>'Les extensions acceptées sont jpeg,png,jpg,gif,svg,pdf,docx,doc,xlsx,ppt,txt,mp3',
            'file1.max'=>'La taille maximale pour un fichier est 10Mo, vérifier votre premier fichier',
            'file2.max'=>'La taille maximale pour un fichier est 10Mo, vérifier votre deuxième fichier',
            'file3.max'=>'La taille maximale pour un fichier est 10Mo, vérifier votre troisième fichier'
        ];

        $validator = Validator::make($request->all(), [
            'description' => 'required|min:10|max:1000',
            'file1' => 'mimes:jpeg,png,jpg,gif,svg,pdf,docx,doc,xlsx,ppt,txt,mp3,mp4,avi,asf,mov,avchd,mpg,mpeg-4,wmv,divx,xls,flv,csv,3gp|max:20000',
            'file2' => 'mimes:jpeg,png,jpg,gif,svg,pdf,docx,doc,xlsx,ppt,txt,mp3,mp4,avi,asf,mov,avchd,mpg,mpeg-4,wmv,divx,xls,flv,csv,3gp|max:20000',
            'file3' => 'mimes:jpeg,png,jpg,gif,svg,pdf,docx,doc,xlsx,ppt,txt,mp3,mp4,avi,asf,mov,avchd,mpg,mpeg-4,wmv,divx,xls,flv,csv,3gp|max:20000'
        ], $messages);



        if ( ! $validator->passes()) { // il y'a un problème avec les règles.
            $error = "Erreur avec vos données ";
            foreach ($validator->errors()->all() as $err){
                $error .= $err;
                $error .= '<br>';
            }

            return response()->json([
                'type'=>'error',
                'message'=>$error]);
        }

        $type = "annonce";
        $period = env('ADS_EXPIRATION_PERIOD',7);
        $dt = Carbon::now();
        $date_expiration = $dt->addDays($period);
       // echo $date_expiration;

        $ads = ads::create([
            'description'=> trim($request->description),
            'expiration_date' => $date_expiration
        ]);


        if(($request->checkbox_even == true) && ($request->expiration_date != "") ){ //C'est un évènement.
            $type = "evenement"; // évènement.
            $date = $request->expiration_date;
            list($year, $month, $days) = explode("-", $date);

            $date_expiration = Carbon::create($year, $month, $days, 0);
            if($date_expiration->isPast()){
                return response()->json([
                    'type'=>'error',
                    'message'=> "La date indiquée pour la reunion est déjà passée. Vérifier la date s'il vous plait"]);
            }
        }

        $ads->type = $type;

        $ads->expiration_date = $date_expiration;
        $file1 = null;
        $file2 = null;
        $file3 = null;

        for($i = 1 ; $i<= 3 ; $i++){
            $name = "file".$i;

            if($request->file($name) != ""){
                $mime = $request->file($name)->extension();
                $id = Auth::id();
                $fullName = $request->file($name)->getClientOriginalName();
                $extension = $request->file($name)->getClientOriginalExtension();
                $onlyName = explode('.'.$extension,$fullName);
                $request->file($name)->move('files_ads', $onlyName[0].'_'.$id.'.'.$extension);
                $chemin =  $onlyName[0].'_'.$id.'.'.$extension;
                $size = $request->file($name)->getClientSize();

                $video_music_ext = array('mp3','3gp','vlc');
                $type = 0; // 0 pour les fichiers (pdf, video, etc....)  et 1 pour les autres (music, video)
                if(in_array($mime, $video_music_ext )){
                    $type=1;
                }

                switch($i){
                    case 1 : $file1 = files::create([
                                            'url'=>$chemin,
                                            'size'=>$size,
                                            'type'=>$type,
                                            'lib'=>false
                                        ]);

                                       break;

                    case 2 : $file2 = files::create([
                                            'url'=>$chemin,
                                            'size'=>$size,
                                            'type'=>$type,
                                            'lib'=>false
                                        ]);
                                        break;
                    case 3 : $file3 = files::create([
                                            'url'=>$chemin,
                                            'size'=>$size,
                                            'type'=>$type,
                                            'lib'=>false
                                        ]);
                                        break;
                    default;
                }
            }
            else {
                switch($i){
                    case 1 : $file1 = null; break;
                    case 2 : $file2 = null; break;
                    case 3 : $file3 = null; break;
                    default;
                }
            }
        }
        //echo $ads->type ;
        $group = group::find($request->id_group);
        $ads->user()->associate(Auth::user());
        $ads->group()->associate($group);
        $live = $request->checkbox_live;
        if($live){
            //BAYOI MET TON CODE ICI.
        }

        $ads->save();
        if($file1 != null){
            $file1->save();
        }
        if($file2 != null) $file2->save();
        if($file3 != null) $file3->save();

        if($file1 != null) {
            $ad_h_file1 = ads_has_files::create();
            $ad_h_file1->ads()->associate($ads);
            $ad_h_file1->files()->associate($file1);
            $ad_h_file1->save();
        }

        if($file2 != null) {
            $ad_h_file2 = ads_has_files::create();
            $ad_h_file2->ads()->associate($ads);
            $ad_h_file2->files()->associate($file2);
            $ad_h_file2->save();
        }

        if($file3 != null) {
            $ad_h_file3 = ads_has_files::create();
            $ad_h_file3->ads()->associate($ads);
            $ad_h_file3->files()->associate($file3);
            $ad_h_file3->save();
        }


        /**Envoie de la notification interne**/

        //notifications aux autres utilisateurs du groupe
        $id_users = usergroup::select('user_id')->where('group_id', '=',$request->id_group)
            ->where('user_id','!=',Auth::id())->where('notification','=',1)->get();
        if($request->checkbox_even == true)
        {
            foreach ($id_users as $id_user)
            {
                $user = User::findorfail($id_user->user_id);
                $user->notify(new NewEvent(Auth::user(), $group));
            }
        }
        else
        {
            foreach ($id_users as $id_user)
            {
                $user = User::findorfail($id_user->user_id);
                $user->notify(new NewAnnouncement(Auth::user(), $group));
            }
        }

        /**Fin de l'envoie**/

        return response()->json([
            'type'=> 'success',
            'message'=> "Votre publication a été publié avec succès."]);

    }

    public function event_group($id){
        $this->load_group();
        $this->verification_param($id);
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group,'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications]);
        }




        $events = ads::orderBy('created_at','desc')
            ->where('archiving','=',false)
            ->where('group_ID','=', $id)
            ->where('type','=', "evenement")
            ->paginate(5);

        if(count($events) == 0){
            $events = null;
        }

        $tab_events_final = null;
        $tab_users= null;

        if($events != null){

            //for($i = 0; $i< $count_ads; $i++){
            foreach($events as  $event){

                $tab_users[''.$event['id'].''] = User::find($event['user_ID']);

                $ad_h_file = ads_has_files::where('ads_ID','=', $event['id'])->get();

                if(count($ad_h_file)){
                    //echo "id = ".$ads;
                    foreach($ad_h_file as $el){
                        $file = files::findOrFail($el->files_ID);
                        $tab_events_final[''.$event['id'].''] =
                            (!isset($tab_events_final[''.$event['id'].'']) && empty($tab_events_final[''.$event['id'].'']))
                                ? $file->url : $tab_events_final[''.$event['id'].''] . '|' .$file->url;

                    }
                }else{
                    $tab_events_final["".$event['id'].""] = null;
                }
                // echo 'fin tour';
            }
        }

        $group = group::findOrFail($id);
        return view('group.event_group',
            ['list_group'=> $this->_list_group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications,
                'group'=>$group,
                'tab_events_final'=>$tab_events_final,
                'tab_users' => $tab_users,
                'events'=>$events
            ]);

    }

    public function ballot_group($id){
        $this->load_group();
        $this->verification_param($id);
        $user = Auth::user();
        $notifications = $user->unreadnotifications()->count();
        if($id==null){
            return view('group.index',['list_group'=> $this->_list_group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications]);
        }
        $group = group::findOrFail($id);
        return view('group.ballot_group',['list_group'=> $this->_list_group, 'id'=>$id,
            'user'=> $user->unreadnotifications,
            'nbr_notif'=> $notifications,
            'group'=>$group]);
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
            $user = Auth::user();
            $notifications = $user->unreadnotifications()->count();
            return view('group.edit_group',['list_group'=> $this->_list_group,'group'=>$group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications]);
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

            $user = Auth::user();
            $notifications = $user->unreadnotifications()->count();

            return view('group.del_group',['list_group'=> $this->_list_group,'group'=>$group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications]);
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

        /**Suppression du groupe dans la session**/
        if(session()->has('group'))
       {
           foreach (session('group') as $group)
           {
               if($group == $id_group)
               {
                   session()->forget('group',$group);
               }
           }
       }
        /**Fin Suppression du groupe dans la session**/

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
                $user = Auth::user();
                $notifications = $user->unreadnotifications()->count();
                return view('group.invitation_group',['list_group'=> $this->_list_group, 'group'=>$group,
                    'user'=> $user->unreadnotifications,
                    'nbr_notif'=> $notifications]);
            }
        }

        else{
            $group = DB::table('group')->whereId($id)->first();
            $user = Auth::user();
            $notifications = $user->unreadnotifications()->count();
            return view('group.invitation_group',['list_group'=> $this->_list_group, 'group'=>$group,
                'user'=> $user->unreadnotifications,
                'nbr_notif'=> $notifications]);
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
        $id_users = usergroup::select('user_id')->where('group_id', '=',$id_group)
            ->where('user_id','!=',Auth::id())->where('notification','=',1)->get();
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
