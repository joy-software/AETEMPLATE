<?php

use Illuminate\Database\Seeder;
use App\User;

class usersTableSeeder extends Seeder
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
        //DB::table('user')->delete();

        for($i = 0; $i < 10; $i++){

            $user = new User([
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
