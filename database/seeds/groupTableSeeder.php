<?php

use Illuminate\Database\Seeder;
use App\group;

class groupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new group([
            'name'=> 'Assemblée Générale',
            'description' =>'Le grand groupe assemblée générale',
            'user_ID' => 1
        ]);
        $group->save();
        $group = new group([
            'name'=> 'Laboratoire de Cybersécurité',
            'description' =>'Le groupe des stagiaires du Lacy',
            'user_ID' => 2
        ]);
        $group->save();
    }
}
