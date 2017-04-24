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

        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner'; // optional
        $owner->description  = 'User is the owner of a given project'; // optional
        $owner->save();

        $permission =  \App\Permission::find(1);
        $owner->attachPermission($permission);

        $user->attachRole($owner);



        $user = new User([
                'name'=> 'Yoba',
                'surname' =>'Rostand',
                'sex' => 'M',
                'profession' => 'ing informaticien',
                'email' => 'rostandyoba2014@gmail.com',
                'password'=> Hash::make('password'),
                'promotion'=> rand(1996, 2015),
                'country'=> $pays[rand(0,3)],
                'phone'=> 'phoneNumber',
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
            'phone'=> 'phoneNumber',
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
            'phone'=> 'phoneNumber',
            'statut'=> 'actif',
            'activated'=> 1,
            'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
        ]);
        $user->save();

        $user = new User([
            'name'=> 'Michel',
            'surname' =>'Bayoi',
            'sex' => 'M',
            'profession' => 'ing informaticien',
            'email' => 'wmbayoi@gmail.com',
            'password'=> Hash::make('password'),
            'promotion'=> rand(1996, 2015),
            'country'=> $pays[rand(0,3)],
            'phone'=> 'phoneNumber',
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
            'phone'=> 'phoneNumber',
            'statut'=> 'actif',
            'activated'=> 1,
            'photo'=> 'default_gent_avatar.png',
            'description' => 'je suis un demarreur',
        ]);
        $user->save();


    }
}
