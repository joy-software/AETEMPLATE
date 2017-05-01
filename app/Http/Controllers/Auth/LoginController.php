<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
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
     * lockoutTime
     *
     * @var
     */
    protected $lockoutTime;

    /**
     * maxLoginAttempts
     *
     * @var
     */
    protected $maxLoginAttempts;

    /**
     * Where to redirect user after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $rules;
    protected $messages;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->redirectTo = '/accueil';
        $this->lockoutTime  = 1;    //lockout for 1 minute (value is in minutes)
        $this->maxLoginAttempts = 3;    //lockout after 3 attempts


        $this->rules = [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',

        ];

        $this->messages = [
            'email.required'        => 'L\'email est obligatoire',
            'email.email'           => 'Email invalide',
            'password.required'     => 'Le mot de passe est obligatoire',
            'password.min'          => 'Le mot de passe doit contenir au moins six caractères',
            'auth.failed'             => "Email ou mode passe incorrect"
        ];
    }


    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxLoginAttempts, $this->lockoutTime
        );
    }



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



    protected function validateLogin(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => 'Email ou mot de passe incorrect',
            ]);
    }

    protected function sendLockoutResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => "Nombres de tentatives expirées. 
               Patientez une minute avant de ressayer."]);
    }
}
