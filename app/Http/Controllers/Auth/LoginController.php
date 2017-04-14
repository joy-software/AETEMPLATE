<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating user for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect user after login.
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
        $this->middleware('guest', ['except' => 'logout']);
        $this->redirectTo = '/accueil';
    }



    /*public function login(Request $request)
    {
        $this->validateLogin($request);


        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $param = $request->only(['email', 'password', 'statut']);
        $password = Hash::make($param['password']);

        $user = User::where('email', $param['email'])->get()->first();

        if (isset($user) && $user != null && Hash::check($param['password'], $user->password)) {

            if (Hash::check( $param['password'], $user->password) && $user->statut == 'actif') {

                if ($this->attemptLogin($request)) {

                        return $this->sendLoginResponse($request);
                }

            } else {

                return $this->sendFailedLoginResponse($request, 'message', "Désolé, votre demande 
                d'adhésion n'a pas encore été validée par les membres de Promotvogt. Merci de réessayez plutard.");
            }

        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request, 'email', 'Identifiants incorrects');
    }*/



    /*protected function sendFailedLoginResponse(Request $request, $label = false, $message = false)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $label => $message
            ]);
    }*/

    protected function authenticated(Request $request, $user)
    {
        if ($user->activated == 0) {

            $this->guard()->logout($user);
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->back()->with(['message' => "Accès impossible : compte non validé. Pour accéder à l'application
                                            suivez le lien de validation qui vous a été envoyé par mail à l'addresse $user->email."]);

        }

        if ($user->statut == 'attente') {

            $this->guard()->logout($user);
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->back()->with(['message' => 'Désolé, votre demande 
                d\'adhésion n\'a pas encore été validée par les membres de Promotvogt. Merci de réessayez plutard.']);

        }

    }


    protected function validator(array $data)
    {

        $validator = Validator::make($data,
            [
                'email'                 => 'required|email',
                'password'              => 'required|min:6|confirmed',
            ],
            [
                'email.required'        => 'L\'email est obligatoire',
                'email.email'           => 'Email invalide',
                'password.required'     => 'Le mot de passe est obligatoire',

            ]
        );

        return $validator;

    }
}
