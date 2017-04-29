<?php

namespace App\Http\Controllers\Auth;

use App\ActivationKey;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\ActivationKeyTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ActivationKeyController extends Controller
{

    use ActivationKeyTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
                'email'                 => 'required|email',
            ],
            [
                'email.required'        => 'L\'email est obligatoire',
                'email.email'           => 'Email invalide',
            ]
        );

        return $validator;

    }

    public function showKeyResendForm(){
        return view('auth.resend_key');
    }

    public function activateKey($activation_key, Request $request)
    {
        // get the activation
        $activationKey = ActivationKey::where('activation_key', $activation_key)
            ->first();

        // determine if the user is logged-in already

        if (Auth::check()) {

            $userToActivate = User::where('id', $activationKey->user_id)->first();

            if (auth()->user()->activated && !empty($userToActivate)) {


                if(Auth::user()->id == $userToActivate->id){

                    $user = Auth::user();
                    $notifications = $user->unreadnotifications()->count();
                    return redirect()->route('accueil',['user'=> $user->unreadnotifications()->paginate(6),'nbr_notif'=> $notifications]);
                }

            }
        }


        // get the activation key and chck if its valid


        if (empty($activationKey)) {
                $msg = 'Le lien d\'activation utilisé est expiré ,invalide ou a déjà été utilisé. <a href="'. route("activation_key_resend").'">Suivez ce lien</a> pour renvoyer un nouveau lien d\'activation.';

                $request->session()->flash("message",  $msg);
                return redirect()->route('login');
        }

        // process the activation key we're received
        $this->processActivationKey($activationKey);

        // redirect to the login page after a successful activation
        return redirect()->route('login')
            ->with('message', "<strong>Félicitation votre compte est activé !</strong> <br>
                                <span style='color: black'> Cependant vous ne pourrez accéder à l'application que lorsque les 
                                membres de Promotvogt valideront votre demande d'adhésion.<br> Un mail vous sera envoyé lorsque
                                 votre demande sera acceptée.</span>")
            ->with('status', 'success');

    }

    public function resendKey(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $email      = $request->get('email');

        // get the user associated to this activation key
        $user = User::where('email', $email)
            ->first();

        if (empty($user)) {
            return redirect()->route('activation_key_resend')
                ->with('message', 'Cet email ne correspond à aucun utilisateur')
                ->with('status', 'warning');
        }

        if ($user->activated) {
            return redirect()->route('activation_key_resend')
                ->with('message', 'Cet email est déjà activé')
                ->with('status', 'success');
        }

        // queue up another activation email for the user
        $this->queueActivationKeyNotification($user);

        return redirect()->route('login')
            ->with('message', 'Un nouveau lien d\'activation vous a été envoyé')
            ->with('status', 'success');
    }
}