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


class adminController extends Controller
{
    private $_user;
    private $_notifications;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function load_users_notification(){
        $this->_user = Auth::user();
        $this->_notifications = $this->_user->unreadnotifications()->count();
        session(['menu' => 'admin']);
    }

    public function index (){

        $this->load_users_notification();
        if( (Auth::user()->hasRole('admin_1')) ){
            //c'est un admin de AG
            $list_group = group::where('id','>',0)->paginate(5);;

            return view('admin.index',[
                'user' =>  $this->_user,
                'nbr_notif'=> $this->_notifications,
                'list_group' => $list_group
            ]);
        }

        $list_role = Role::where('name','!=','comptable')
            ->where('name','!=','admin_1')
            ->get();

        $user_aut = Auth::user();
        $compteur = 0;

        foreach ($list_role as $item) {
            if( ($user_aut->hasRole($item['name'])) ){
                //echo $item['name'];
                $list_group[$compteur] = group::where('id', '=', $item['group_ID'])->first();
                $compteur++;
            }
        }

        if($compteur == 0){
            //il n'est admin d'aucun groupe.
            return Redirect::back();
        }

        return view('admin.index',[
            'user' =>  $this->_user,
            'nbr_notif'=> $this->_notifications,
            'list_group'=>$list_group
        ]);

    }

    public function admin_roles(){

        $count_admin = Role::where('name','=','admin_1')->get()->count();
        if($count_admin == 0 || $count_admin > 1){
            $message = "<div class=\"alert alert-error alert-danger fade in\"> Il se peut que le rôle de l'administrateur du groupe AG n'existe pas ou qu'il y ai plusieurs rôles d'AG. </div>";
            return view('admin.admin_roles',[
                        'user' =>  $this->_user,
                        'nbr_notif'=> $this->_notifications,
                        'list_users' => null,
                        'message'=>$message
                    ]);
        }

        $count_compta = Role::where('name','=','comptable')->get()->count();
        if($count_compta == 0 || $count_compta > 1){
            $message = "<div class=\"alert alert-error alert-danger fade in\"> Il se peut que le rôle de comptabilité n'existe pas ou qu'il y ai plusieurs rôles de comptabilité créés. </div>";
            return view('admin.admin_roles',[
                'user' =>  $this->_user,
                'nbr_notif'=> $this->_notifications,
                'list_users' => null,
                'message'=>$message
            ]);
        }


        //$list_users = User::all();
        $list_users = User::where('id', '>', 0)->paginate(5);
        //$list_users = $list_users->paginate(5);

        $_compta = Role::where('name','=','comptable')->get()->first();
        $_admin = Role::where('name','=','admin_1')->get()->first();

        $roles_compta[] = null;
        $roles_admin[] = null;

        foreach ($list_users as $item){
            $count_admin = DB::table('role_user')->where('role_id', $_admin->id)
                                                        ->where('user_id',$item['id'])
                                                        ->get()->count();

            $count_compta = DB::table('role_user')->where('role_id', $_compta->id)
                ->where('user_id',$item['id'])
                ->get()->count();

            if($count_compta == 1){
                $roles_compta[''.$item['id'].''] = "<span class='badge bg-success'>Ce membre est Comptable</span>";
            }
            else{
                $roles_compta[''. $item['id'] .''] = null;
            }


            if($count_admin == 1){
                $roles_admin[''.$item['id'].''] = "<span class='badge bg-success'>Ce membre est Administrateur</span>";
            }
            else{
                $roles_admin[''.$item['id'].''] = null;
            }

        }
        $this->load_users_notification();
        return view('admin.admin_roles',[
            'user' =>  $this->_user,
            'nbr_notif'=> $this->_notifications,
            'list_users' => $list_users,
            'roles_compta'=>$roles_compta,
            'roles_admin'=>$roles_admin
        ]);
    }

    public function post_role_compta(Request $request){
        $id_user = $request->get('id_user');

        $message = "<div class=\"alert alert-error alert-danger fade in\"> Vous n'avez pas le rôle pour définir ce membre comme comptable.</div>";

       if( (! Auth::user()->hasRole('admin_1')) ) {
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $count_role_compta = Role::where('name','=','comptable')->get()->count();
        if($count_role_compta != 1){
            $message = "<div class=\"alert alert-error alert-danger fade in\">Erreur : il semble que le rôle comptabilité ne soit pas encore crée ou qu'il en existe plusieurs.</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }
        $role_compta = Role::where('name','=','comptable')->get()->first();
        $count_user_compta = DB::table('role_user')
                                ->where('user_id','=',$id_user)
                                ->where('role_id','=',$role_compta->id)
                                ->get()
                                ->count();
        if($count_user_compta > 0){
            $message = "<div class=\"alert alert-error alert-danger fade in\">Ce membre a déjà les droits de comptabilités</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        DB::table('role_user')->insert([
           'user_id'=> $id_user,
            'role_id'=> $role_compta->id
        ]);

        $user = User::find($id_user);
        $message = "<div class=\"alert alert-success fade in\">Le membre ". $user->name . " , ". $user->surname . " a dorénavant les droits de comptabilité</div>";
        return response()->json([
            'type'=>'success',
            'message'=>$message]);

    }

    public function post_role_admin(Request $request){
        $id_user = $request->get('id_user');

        $message = "<div class=\"alert alert-error alert-danger fade in\"> Vous n'avez pas le rôle pour définir ce membre comme  administrateur </div>";

      if( (! Auth::user()->hasRole('admin_1')) ) {
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $count_role_admin = Role::where('name','=','admin_1')->get()->count();
        if($count_role_admin != 1){
            $message = "<div class=\"alert alert-error alert-danger fade in\">Erreur : il semble que le rôle <strong>'Administrateur'</strong> ne soit pas encore créé ou qu'il en existe plusieurs.</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }
        $role_admin = Role::where('name','=','admin_1')->get()->first();
        $count_user_admin = DB::table('role_user')
                                ->where('user_id','=',$id_user)
                                ->where('role_id','=',$role_admin->id)
                                ->get()
                                ->count();
        if($count_user_admin > 0){
            $message = "<div class=\"alert alert-error alert-danger fade in\">Ce membre a déjà les droits d'administrateur d'AG</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        DB::table('role_user')->insert([
           'user_id'=> $id_user,
            'role_id'=> $role_admin->id
        ]);

        $user = User::find($id_user);
        $message = "<div class=\"alert alert-success fade in\">Le membre ". $user->name . " , ". $user->surname . " a dorénavant les droits de d'administrateur d'AG</div>";
        return response()->json([
            'type'=>'success',
            'message'=>$message]);

    }


    public function post_remove_compta(Request $request){

        $id_user = $request->get('id_user');

        $message = "<div class=\"alert alert-error alert-danger fade in\"> Vous n'avez pas les droits pour retirer les droits de comptabilité à cet utilisateur. Vous devez avoir le droit d'administrateur d'AG</div>";

        if((! Auth::user()->hasRole('admin_1')) ) {
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $count_role_compta = Role::where('name','=','comptable')->get()->count();
        if($count_role_compta != 1){
            $message = "<div class=\"alert alert-error alert-danger fade in\">Erreur : il semble que le rôle comptabilité ne soit pas encore crée ou qu'il en existe plusieurs.</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }
        $role_compta = Role::where('name','=','comptable')->get()->first();
        $count_user_compta = DB::table('role_user')
            ->where('user_id','=',$id_user)
            ->where('role_id','=',$role_compta->id)
            ->get()
            ->count();
        if($count_user_compta == 0){
            $message = "<div class=\"alert alert-error alert-danger fade in\">Ce membre n'a pas les droits de comptabilité</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        DB::table('role_user')->where('user_id','=', $id_user)
                                    ->where('role_id', '=', $role_compta->id)
                                    ->delete();

        $user = User::find($id_user);
        $message = "<div class=\"alert alert-success fade in\">Le membre ". $user->name . " , ". $user->surname . " n'est plus dorénavant comptable. </div>";
        return response()->json([
            'type'=>'success',
            'message'=>$message]);


    }


    public function suspen_user($id_group){

        if( (! Auth::user()->hasRole('admin_'. $id_group)) && (! Auth::user()->hasRole('admin_1')) ) {
            return Redirect::back();
        }

        $count_user = usergroup::where('group_ID', '=',$id_group)->get()->count();
        if($count_user == 0){
            return Redirect::back();
        }
        $this->load_users_notification();
        $group = group::find($id_group);

        if( ($count_user == 1) && ( Auth::user()->hasRole('admin_'. $id_group))){
            //ça veut dire que je suis le seul utilisateur du groupe et je ne dois pas être suspendu.

            return view('admin.suspen_user',[
                'user' =>  $this->_user,
                'nbr_notif'=> $this->_notifications,
                'list_users' => null,
                'group'=>$group,
                'roles'=>null
            ]);
        }

        $user_group = usergroup::where('group_ID', '=',$id_group)
                            ->where('statut','!=','suspendu')
                            ->get();
        $list_users = null;
        $roles = null;
        foreach ($user_group as $item){
            $user_find = User::find($item['user_ID']);
            $list_users[] = $user_find;
            if($user_find->hasRole('admin_'.$id_group)){
                $roles[''.$item['user_ID'].''] = "<span class='badge bg-success'>Ce membre est Administrateur</span>";
            }
            else {
                $roles[''.$item['user_ID'.'']] = null;
            }

        }

        $this->load_users_notification();
        return view('admin.suspen_user',[
            'user' =>  $this->_user,
            'nbr_notif'=> $this->_notifications,
            'list_users'=>$list_users,
            'group'=> $group,
            'roles'=>$roles
        ]);

    }

    public function post_suspen_user(Request $request){

        $id_group = $request->get('id_group');
        $id_user = $request->get('id_user');

        $message = "<div class=\"alert alert-error alert-danger fade in\"> Vous n'avez pas le droit de suspendre ce membre. Vous devez être administrateur de ce groupe. </div>";

        if( (! Auth::user()->hasRole('admin_'. $id_group)) ) {
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $count_user = usergroup::where('user_ID', '=', $id_user)
                    ->where('group_ID','=', $id_group)
                    ->get()
                    ->count();

        if($count_user == 0){
            $message = "<div class=\"alert alert-error alert-danger fade in\"> Ce membre n'existe même pas </div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $result = usergroup::where('user_ID', '=', $id_user)
            ->where('group_ID','=', $id_group)
            ->get()
            ->first();

        $user = User::find($id_user);

        $user_group = usergroup::find($result['id']);
        $user_group->statut = "suspendu";
        $user_group->save();

        $message = "<div class=\"alert alert-success alert-danger fade in\"> Le membre ". $user->name . " , ". $user->surname ." a été suspendu du groupe avec succès</div>";

        return response()->json([
            'type'=>'success',
            'message'=>$message]);

    }

    public function post_admin_user(Request $request){
        $id_group = $request->get('id_group');
        $id_user = $request->get('id_user');
        $message = "<div class=\"alert alert-error alert-danger fade in\"> Vous n'avez pas le droit d'ajouter ce membre comme administrateur. Seul les administrateurs de ce groupe peuvent le faire.</div>";
        if(! Auth::user()->hasRole('admin_'. $id_group) ) {
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $count_role = Role::where('name','=','admin_'.$id_user)->get()->count();

        if( ($count_role == 0) || ($count_role > 1)){
            $message = "<div class=\"alert alert-error alert-danger fade in\"> Impossible de le définir administrateur, le role administrateur n'existe pas.</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $count_user = User::where('id','=',$id_user)->get()->count();
        if($count_user == 0){
            $message = "<div class=\"alert alert-error alert-danger fade in\"> Ce membre n'existe pas.</div>";
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        $role = Role::where('name','=','admin_'.$id_user)->get()->first();

        $user = User::find($id_user);
        $user->attachRole($role);

        $message = "<div class=\"alert alert-success alert-danger fade in\"> ". $user->name . " , " . $user->surname . " a été défini administrateur de ce groupe avec succès</div>";
        return response()->json([
            'type'=>'success',
            'message'=>$message]);

    }

    public function del_group(Request $request){
        $id_group = $request->get('id_group');
        $message = "<div class=\"alert alert-error alert-danger fade in\"> Vous n'avez pas le droit de supprimer ce groupe </div>";
        if( (! Auth::user()->hasRole('admin_'. $id_group)) && (! Auth::user()->hasRole('admin_1')) ) {
            return response()->json([
                'type'=>'success',
                'message'=>$message]);
        }

        if($id_group == 1){
            $message = $message = "<div class=\"alert alert-error alert-danger fade in\"> Le groupe Assemblé Général est le groupe principal, vous ne pouvez pas le supprimer. </div>";
            return response()->json([
                'type'=>'error',
                'message'=>$message]);
        }

        $group = group::find($id_group);
        $id_users = DB::table('usergroup')->select('id')->where('group_ID','=',$id_group)->get();

        foreach ($id_users as $el){
            DB::table('usergroup')->delete($el->id);
        }

        $role  = DB::table('roles')->where('name','=','admin_'.$id_group)->get();
        $role = $role[0];

        DB::table('role_user')->where('role_id', $role->id)->delete();
        DB::table('permission_role')->where('role_id', $role->id)->delete();

        $message = "<div class=\"alert alert-success alert-danger fade in\"> Le groupe ". $group->name . " a été supprimé avec succès</div>";
        $group->delete();

        return response()->json([
            'type'=>'success',
            'message'=>$message]);
    }

}