<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        //return $data;
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
            'photo' => $data['photo']

        ]);
    }

    protected function registered(Request $request, $user)
    {
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
