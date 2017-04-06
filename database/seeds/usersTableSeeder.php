<?php

use Illuminate\Database\Seeder;
use App\users;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('users')->delete();

        $pays = array('cameroun', 'france','allemagne','usa');
        //DB::table('users')->delete();

        for($i = 0; $i < 10; $i++){
         /*  DB::table('users')->insert([
                'name'=> 'Nom'.$i,
                'surname' =>'Surname'.$i,
                'profession' => 'profession'.$i,
                'email' => $i.'email@gmail.com',
                'password'=> bcrypt('password'.$i),
                'promotion'=> rand(1996, 2015),
                'country'=> $pays[rand(0,3)],
                'phone'=> 'phoneNumber'.$i,
                'statut'=> rand(0,2),
                'photo'=> 'none'
            ]);//*/


        $user = new users([
                'name'=> 'Nom'.$i,
                'surname' =>'Surname'.$i,
                'profession' => 'profession'.$i,
                'email' => $i.'email@gmail.com',
                'password'=> bcrypt('password'.$i),
                'promotion'=> rand(1996, 2015),
                'country'=> $pays[rand(0,3)],
                'phone'=> 'phoneNumber'.$i,
                'statut'=> rand(0,2),
                'photo'=> 'none'
            ]);
        $user->save();

        }
    }
}
