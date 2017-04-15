<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect user after resetting their password.
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
        $this->redirectTo = route('login');
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->logout($user);

    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected function validationErrorMessages()
    {
        return [

            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Email invalide',
            'email.exists' => 'Cet email ne correspond à aucun utilisateur',
            'password.required' => 'Le mot de passe obligatoire',
            'password.confirmed' => 'Les mots de passe sont différents',
            'password.min' => 'Le mot de passe doit contenir au moins six caractères'

        ];
    }

    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
            ->with('message', 'Votre mot de passe a été modifié avec succès.');
    }


}
