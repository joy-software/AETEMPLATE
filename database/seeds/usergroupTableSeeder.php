<?php

use Illuminate\Database\Seeder;
use App\usergroup;

class usergroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usergroup = new usergroup([
            'statut'=> 'actif',
            'notification' => 1,
            'user_ID' => 1,
            'group_ID' => 1,
            'id_validator' => 1
        ]);
        $usergroup->save();

        for($i = 2; $i < 7; $i++){
            $usergroup = new usergroup([
                'statut'=> 'actif',
                'notification' => 1,
                'user_ID' => $i,
                'group_ID' => 1,
                'id_validator' => 1
            ]);
            $usergroup->save();
        }


    }
}
