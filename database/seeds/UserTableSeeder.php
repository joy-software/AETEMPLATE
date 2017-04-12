<?php

use Illuminate\Database\Seeder;
use App\User;

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

        for($i = 0; $i < 10; $i++){

            $user = new User([
                    'name'=> 'Nom'.$i,
                    'surname' =>'Surname'.$i,
                    'sex' => $sexe[rand(0,1)],
                    'profession' => 'profession'.$i,
                    'email' => $i.'email@gmail.com',
                    'password'=> Hash::make('password'.$i),
                    'promotion'=> rand(1996, 2015),
                    'country'=> $pays[rand(0,3)],
                    'phone'=> 'phoneNumber'.$i,
                    'statut'=> 'actif',
                    'photo'=> 'none',
                'description' => 'je m\'appelle Nom'.$i,
                ]);
            $user->save();

        }


    }
}
