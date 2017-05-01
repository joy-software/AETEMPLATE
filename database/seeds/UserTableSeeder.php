<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('user')->delete();

        $pays = array('cameroun', 'france','allemagne','usa');
        $sexe = array('M', 'F');
        //DB::table('user')->delete();
        $user = new User([
            'name'=> 'admin',
            'surname' =>'promot',
            'sex' => 'M',
            'profession' => 'administrateur',
            'email' => 'admpromot@gmail.com',
            'description' => 'je suis l\'admin',
            'password'=> Hash::make('promotvogt'),
            'promotion'=> 2017,
            'country'=> 'Cameroun',
            'phone'=> '00237123456789',
            'statut'=> 'actif',
        ]);
        $user->save();



        $user = new User([
                'name'=> 'Yoba',
                'surname' =>'Rostand',
                'sex' => 'M',
                'profession' => 'ing informaticien',
                'email' => 'rostandyoba2014@gmail.com',
                'password'=> Hash::make('password'),
                'promotion'=> rand(1996, 2015),
                'country'=> $pays[rand(0,3)],
                'phone'=> '698754231',
                'statut'=> 'actif',
                'activated'=> 1,
                'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
            ]);
        $user->save();

        $user = new User([
            'name'=> 'Joy',
            'surname' =>'Jedidja',
            'sex' => 'M',
            'profession' => 'ing informaticien',
            'email' => 'joyjedid@gmail.com',
            'password'=> Hash::make('password'),
            'promotion'=> rand(1996, 2015),
            'country'=> $pays[rand(0,3)],
            'phone'=> '698756324',
            'statut'=> 'actif',
            'activated'=> 1,
            'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
        ]);
        $user->save();

        $user = new User([
            'name'=> 'Yobi',
            'surname' =>'York',
            'sex' => 'M',
            'profession' => 'ing informaticien',
            'email' => 'yobarostand@yahoo.fr',
            'password'=> Hash::make('password'),
            'promotion'=> rand(1996, 2015),
            'country'=> $pays[rand(0,3)],
            'phone'=> '678451254',
            'statut'=> 'actif',
            'activated'=> 1,
            'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
        ]);
        $user->save();

        $compta = new Role();
        $compta->name         = 'comptable';
        $compta->display_name = 'Le comptable du project'; // optional
        $compta->description  = 'La personne en charge des finances du groupe'; // optional
        $compta->save();

        $permission =  \App\Permission::find(1);
        $compta->attachPermission($permission);

        $user->attachRole($compta);

        $user = new User([
            'name'=> 'Michel',
            'surname' =>'Bayoi',
            'sex' => 'M',
            'profession' => 'ing informaticien',
            'email' => 'wmbayoi@gmail.com',
            'password'=> Hash::make('password'),
            'promotion'=> rand(1996, 2015),
            'country'=> $pays[rand(0,3)],
            'phone'=> '677854123',
            'statut'=> 'actif',
            'activated'=> 1,
            'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
        ]);
        $user->save();

        $user = new User([
            'name'=> 'Jedidja',
            'surname' =>'Joy',
            'sex' => 'M',
            'profession' => 'ing informaticien',
            'email' => 'jedidjajoy@yahoo.fr',
            'password'=> Hash::make('password'),
            'promotion'=> rand(1996, 2015),
            'country'=> $pays[rand(0,3)],
            'phone'=> '696784565',
            'statut'=> 'actif',
            'activated'=> 1,
            'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
        ]);
        $user->save();


    }
}
