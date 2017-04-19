<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Traits\ActivationKeyTrait;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new user as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use ActivationKeyTrait;

    /**
     * Where to redirect user after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo = '/accueil';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validator = Validator::make($data,
            [
                'name'               => 'required|max:100|min:2',
                'surname'            => 'required|max:100|min:2',
                'email'                 => 'required|email|unique:users',
                'password'              => 'required|min:6|confirmed',
                'password_confirmation' => 'required|same:password',

            ],
            [
                'name.required'     => 'Ce champs est obligatoire',
                'name.min'           => 'Le nom doit contenir au moins 2 caractères',
                'name.max'           => 'Le nom doit contenir au plus 100 caractères',
                'surname.required'   => 'Ce champ est obligatoire',
                'surname.min'    => 'Le prénom doit contenir au moins  2 caractères',
                'surname.max'    => 'Le prénom doit contenir au plus  100 caractères',
                'email.required'        => 'Ce champ est obligatoire',
                'email.email'           => 'Addresse email invalide',
                'email.unique'           => 'Cette adresse est déjà utilisée',
                'password.required'     => 'Ce champ est obligatoire',
                'password.min'          => 'Le mot de passe doit contenir au moin 6 caractères',
                'password_confirmation.required'    => 'Ce champ est obligatoire',
                'password_confirmation.same'    => 'Ce champ est différent du mot de passe',
            ]
        );

        return $validator;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([

            'surname' => $data['surname'],
            'name' => $data['name'],
            'sex' => $data['sex'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'promotion' => $data['promotion'],
            'email' => $data['email'],
            'country' => $data['country'],
            'profession' => $data['profession'],
            'description' => $data['description'],
            'password' => Hash::make($data['password']),
            'activated' => !config('settings.send_activation_email')

        ]);
    }

    protected function registered(Request $request, $user)
    {

        if($request->file("logo") == null){
            $extension = null;
            $chemin = 'logos/default.png';
        }
        else{

            $request->file('logo')->move('logos', $request->file('logo')->getClientOriginalName());
            $chemin = 'logos/'. $request->file('logo')->getClientOriginalName();
        }

        $this->queueActivationKeyNotification($user);
        $this->guard()->logout($user);
        $request->session()->flush();
        $request->session()->regenerate();

        /*return view('auth.register_success')->with('message', 'Inscription réussie. Pour activer votre
        compte suivez le lien de validation qui vous a été envoyé puis réessayez quelques jours plutard le temps
         que les membres de promotvogt accepte votre demande d\'adhésion. Merci !');*/

        return redirect()->route('register')->with(['message' => 'Inscription réussie. Pour activer votre
        compte suivez le lien de validation qui vous a été envoyé à l\'adresse '. $user->email . '. Merci !']);
    }
}
