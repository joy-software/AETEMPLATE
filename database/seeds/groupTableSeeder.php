<?php

use Illuminate\Database\Seeder;
use App\group;
use App\Role;

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
            'user_ID' => 1,
            'logo' => 'default.png'
        ]);
        $group->save();

        /**on le role de administrateur pour AG****/
        $admin = new Role();
        $admin->name         = 'admin_1';
        $admin->display_name = 'User Administrator of AG group'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->group_ID  = 1; // optional
        $admin->save();

        $permission =  \App\Permission::find(1);
        $admin->attachPermission($permission);

        //on attache le rôle admin au créateur du groupe
        $user = \App\User::find(1);
        $user->attachRole($admin);

        $user = \App\User::find(2);
        $user->attachRole($admin);

        $user = \App\User::find(3);
        $user->attachRole($admin);

        $user = \App\User::find(4);
        $user->attachRole($admin);
    }
}
