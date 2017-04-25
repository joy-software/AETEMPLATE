<?php

namespace App\Http\Controllers;


use App\contribution;
use App\User;
use Illuminate\Http\Request;
use App\period;
use Validator;
use App\motif;
use Redirect;
use Illuminate\Support\Facades\Input;
use Excel;

use Auth;

class comptabiliteController extends Controller
{
    private $_user;
    private $_notifications;
    private $_periodes;
    private $_motifs;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function load_users_notification_period(){

        //// Chargements des périodes
        $count_period= period::get()->count();
        if($count_period > 5){
            $this->_periodes  = period::orderBy('created_at','desc')
                ->take(5);
        }
        else if($count_period == 0){
            $this->_periodes  = null;
        }
        else{
            $this->_periodes = period::orderBy('created_at','desc')
                ->get();
        }

        // Chargements des motifs
        $this->_motifs = motif::orderBy('created_at','desc')->get();

        $count_motif = count($this->_motifs);
        if($count_motif == 0){
            $this->_motifs  = null;
        }


        $this->_user = Auth::user();
        $this->_notifications = $this->_user->unreadnotifications()->count();
    }

    public function index(){
        $this->load_users_notification_period();

        return view('comptabilite.index',[
            'user' =>  $this->_user,
            'nbr_notif'=> $this->_notifications,
            'periodes'=> $this->_periodes,
            'motifs'=>$this->_motifs
            ]);
    }

    public function consult_contribution(){
        $this->load_users_notification_period();
        return view('comptabilite.consult_contribution', [
            'user'=>$this->_user,
            'nbr_notif'=>$this->_notifications,
            'periodes'=> $this->_periodes,
            'motifs'=>$this->_motifs
        ]);
    }

    /**
     * @param Request $request
     * Cette fonction permet de gerer le paiment des cotisations à partir d'un fichier excel.
     */
    public function post_contribution_file(Request $request){

        $messages_validation = [
            'contribution_file.required' => "Vous avez oublié le fichier des contributions, ce fichier est OBLIGATOIRE",
            'contribution_file.max'=>"votre fichier doit peser maximum 10 Mo",
            'contribution_file.mimes'=> "Votre fichier doit avoir l'extention .csv, xls, xlsx"
        ];

        $validator = Validator::make($request->all(), [
            'contribution_file' => 'required|mimes:csv,xls,xlsx|max:10000'
        ], $messages_validation);

        if ( ! $validator->passes()) { // il y'a un problème avec les règles.
            $error = "<br>";
            foreach ($validator->errors()->all() as $err){
                $error .= "<div class=\"alert alert-block alert-danger fade in\">". $err ."</div>";
            }

            return response()->json([
                'type'=>'error',
                'message'=>$error]);
        }


        if(!empty($request->file('contribution_file'))){
            $path = Input::file('contribution_file')->getRealPath();
            //$path = $request->file('contribution_file')->getRealPath();

            $id_motif = $request->get('motif');
            $id_periode = $request->get('periode');

            $data = Excel::load($path, function($reader) {
            })->get();

            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['email' => $value->email, 'amount' => $value->montant];
                }
                if((!empty($insert)) && (count($insert) > 1) ){

                    $messages = "<br>";

                    foreach ($insert as $item){
                        if(!empty($item)){

                            $user = User::where('email','=', $item['email'])->first();
                            if(count($user) == 0){
                                $messages .= "<div class=\"alert alert-block alert-danger fade in\"> Le membre d'email <strong>". $item['email'] ."</strong> ".
                                    "n'existe pas, par conséquent sa contribution n'a pas été enregistrée </div>";
                            }
                            else {
                                //$user = User::where('email','=', $item['email']);
                                $count_contrib = contribution::where('user_ID','=',$user['id'])
                                    ->where('period_ID','=',$id_periode)
                                    ->where('motif_ID','=',$id_motif)
                                    ->count();

                                if( $count_contrib != 0){ // ça veut dire qu'il y a déjà une telle contribution dans la bd.
                                    $messages .= "<div class=\"alert alert-block alert-danger fade in\"> Le membre ". $user['name'] ." d'email <strong>". $item['email'] ."</strong> ".
                                        "a déjà contribué pour cette période et pour le même motif, par conséquent sa contribution n'a pas été enregistrée </div>";
                                }
                                else{
                                    $contribution = contribution::create([
                                        'amount' => $item['amount']
                                    ]);

                                    $contribution->motif()->associate($id_motif);
                                    $contribution->users()->associate($user['id']);
                                    $contribution->period()->associate($id_periode);
                                    $contribution->save();

                                    $messages .= "<div class=\"alert alert-success fade in\"> La contribution du membre ". $user['name'] ." d'email <strong>". $item['email'] ."</strong> a été enregistré avec succès</div>";

                                     }

                                }

                        }


                    }

                    return response()->json([
                        'type'=>'success',
                        'message'=>$messages]);

                }
                else{ // le fichier excel est vide.
                   $messages = "<div class=\"alert alert-block alert-danger fade in\"> Votre fichier excel est vide,".
                       "s'il vous plait remplisser le fichier avant de charger les contributions des membres </div>";
                    return response()->json([
                        'type'=>'error',
                        'message'=>$messages]);
                }
            }
        }

    }


public function post_contribution(Request $request){

        $email = $request->get('email_membre');
        $amount = $request->get('amount');
        $id_motif = $request->get('motif');
        $id_period = $request->get("periode");

        $user = User::where('email','=', $email)->get();

        if($amount == 0){
            $message = "<div class=\"alert alert-block alert-danger fade in\">S'il vous plait renseignez le montant, il ne doit pas être vide ou null</div>";
            return response()->json([
                'type'=>'error',
                'message'=> $message
            ]);
        }

        if(count($user) == 0){
            $message = "<div class=\"alert alert-block alert-danger fade in\">Aucun membre ayant l'email : <strong>". $email . "</strong> n'existe </div>";
            return response()->json([
                'type'=>'error',
                'message'=> $message
            ]);
        }

    $user = User::where('email','=', $email)->first();

        $count_contrib = contribution::where('user_ID','=',$user['id'])
            ->where('period_ID','=',$id_period)
            ->where('motif_ID','=',$id_motif)
            ->count();

        if($count_contrib != 0){
            $message = "<div class=\"alert alert-block alert-danger fade in\">Le membre ". $user['name']. " d'email : <strong>". $email . "</strong> a déjà contribué pour cette période et pour le même motif  </div>";
            return response()->json([
                'type'=>'error',
                'message'=> $message
            ]);
        }

        $contribution = contribution::create([
            'amount'=>$amount
        ]);

        $contribution->period()->associate($id_period);
        $contribution->users()->associate($user['id']);
        $contribution->motif()->associate($id_motif);
        $contribution->save();

        $message = "<div class=\"alert alert-success fade in\">La cotisation du membre ". $user['name']. " d'email : <strong>". $email . "</strong> a bien été enregistrée </div>";
        return response()->json([
            'type'=>'success',
            'message'=> $message
        ]);

}

public function post_period(Request $request){
    $mois = $request->get('mois');
    $annee = $request->get('annee');

    if($annee == 0){
        $message = "<div class=\"alert alert-block alert-danger fade in\">S'il vous plait vérifiez vos champs car l'année est vide</div>";
        return response()->json([
            'type'=>'success',
            'message'=> $message
        ]);
    }

    $count_period = period::where('year','=', $annee)
        ->where('month','=', $mois)
        ->count();
    if($count_period != 0){
        $message = "<div class=\"alert alert-block alert-danger fade in\">Impossible de créer cette période, la période ". strtoupper($mois) ." - ". $annee ." existe déjà </div>";
        return response()->json([
            'type'=>'error',
            'message'=> $message
        ]);
    }

    $period = period::create([
        'year'=>$annee,
        'month'=> $mois
    ]);

    $period->save();
    $message = "<div class=\"alert alert-success fade in\">La période ". strtoupper($period->month) ." - ". $period->year . "</strong> a bien été créer </div>";
    return response()->json([
        'type'=>'success',
        'message'=> $message
    ]);

}

public function post_motif(Request $request){
    $reason = $request->get('motif');
    if( motif::where("reason","=",$reason)->get()->count() != 0){
        $message = "<div class=\"alert alert-danger fade in\">le motif \"". $reason ."\"  existe déjà , vous ne pouvez plus créer ce motif.</div>";
        return response()->json([
            'type'=>'success',
            'message'=> $message
        ]);
    }

    $motif = motif::create([
        'reason'=> $reason
    ]);
    $motif->save();

    $message = "<div class=\"alert alert-success fade in\">le motif \"". $reason ."\"  a bien été créé</div>";
    return response()->json([
        'type'=>'success',
        'message'=> $message
    ]);

}



public function post_consult_contribution(Request $request){

    $period = $request->get("periode");
    $motif = $request->get("motif");

    $result_count = contribution::where('period_ID','=', $period)
        ->where('motif_id','=',$motif)->get()->count();

    if($result_count == 0){
        $message = "<tr><td><div class=\"alert alert-danger fade in pull-left \">Aucune contribution ne correspond à votre recherche </div></td></tr>";
        return response()->json([
           'type'=> 'success',
            'message'=> $message
        ]);
    }


    $message = " ";

    $results = contribution::where('period_ID','=', $period)
        ->where('motif_ID','=',$motif)->get();

    //echo $results[0];

    foreach ($results as $item){

       // $message =  "nous sommes déjà présent;";
        $user = User::find($item['user_ID']);

        $message .= "<tr><td><span class='profile-ava'><img alt='' class='simple' src='/" . $user->photo . "' </span> </td>" .
                    "<td> ". $user->name ." , ". $user->surname ." </td> " .
                    "<td> ". $user->email .", <br> Tel : ". $user->phone ."</td> " .
                    //"<td> <a class='btn btn-primary btn-contribution' data-toggle='modal' data-target='#modalContribution' id='btn-contrib-". $user->id ."'> Voir ses contributions </a> </td> ".
                    "<td> <a class='btn btn-primary ' data-toggle='modal'  href='/contrib_user/". $user->id . "' id='btn-contrib-". $user->id ."'> Voir ses contributions </a> </td> ".
                    "</tr>";
    }

    return response()->json([
        'type'=> 'success',
        'message'=> $message
    ]);

}

public function contribution_user(Request $request)
{

    $id_user = $request->get('id_user');

    $user = User::find($id_user);

    $count = contribution::where('user_ID','=',$id_user)->count();

    if($count == 0){
        return response()->json([
            'type'=> 'success',
            'message'=> "<tr> <td> Aucune contribution pour cette utilisateur</td></tr>"
        ]);
    }

    $message = " ";
    $contribution_user = contribution::where('user_ID','=',$id_user)->get();

    foreach ($contribution_user as $item){
        $motif = motif::find($item['motif_id']);
        $period = period::find($item['period_ID']);
        $message .= "<tr><td> ". strtoupper($period->month) . " - " . $period->year ." </td>" .
            "<td> ". $motif->reason ." </td> " .
            "<td> ". $item['amount'] ."</td> " .
            "</tr>";
    }

    return response()->json([
        'type'=> 'success',
        'message'=> $message,
        'userName'=> $user->name . ", " . $user->surname
    ]);

}

public function contrib_user_email(Request $request){
    $email = $request->get('email');

    $count = User::where('email','=', $email)->get()->count();
    if($count == 0){
        return response()->json([
            'message'=> "<div class=\"alert alert-danger fade in pull-left \"> Aucun membre n'a cette adresse email </div>",
        ]);
    }
    $user = User::where('email','=', $email)->get();

    Redirect::route('contribution_user', ['id' => $user[0]['id']]);

}

public function contrib_user($id){

    $this->load_users_notification_period();
    $count = User::where('id','=',$id)->count();

    if($id != Auth::id()){
        return Redirect::back();

    }

    if($count == 0){
        return Redirect::back();
    }

    $user = User::find($id);
    $count_contrib = contribution::where('user_ID','=',$id)->get()->count();

    if($count_contrib == 0){
        return view('comptabilite.contrib_user',[
            'user' =>  $this->_user,
            'nbr_notif'=> $this->_notifications,
            //'periodes'=> $this->_periodes,
            //'motifs'=>$this->_motifs
            'motifs' => null,
            'periodes'=>null,
            'montant' => null,
            'nom_user' => $user->name .' , '. $user->surname
        ]);
    }

    $contrib = contribution::where('user_ID','=',$id)->get();
    $message = " ";
    $compteur = 0;
    foreach( $contrib as $item ){
        $motif = motif::find($item['id']);
        $period = period::find($item['id']);

        $motifs[''. $compteur .''] = $motif->reason;
        $periodes[''. $compteur .''] = strtoupper($period->month) . " - " . $period->year;
        $montant['' .$compteur .''] = $item['amount'];
        $compteur ++;
    }

    return view('comptabilite.contrib_user',[
        'user' =>  $this->_user,
        'nbr_notif'=> $this->_notifications,
        'periodes'=>  $periodes,
        'motifs' => $motifs,
        'montant'=> $montant,
        'nom_user' => $user->name .' , '. $user->surname,
        'compteur' => $compteur
    ]);


}


}
