<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\period;
use Validator;

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
        else{
            $this->_motifs = period::orderBy('created_at','desc')
                ->get();
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

        $messages = [
            'contribution_file.required' => "vous devez donner une description à l'annonce",
            'contribution_file.max'=>'votre fichier doit peser maximum 10 Mo',
            'contribution_file.mimes'=>'Votre fichier doit avoir l\'extention .csv'
        ];

        $validator = Validator::make($request->all(), [
            'contribution_file' => 'required|mimes:csv|max:10000'
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


        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['title' => $value->title, 'description' => $value->description];
                }
                if(!empty($insert)){
                    DB::table('items')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }

        return response()->json([
            'type'=>'success',
            'message'=>"le formulaire est passé avec succès"]);


       // return back();

    }





}
