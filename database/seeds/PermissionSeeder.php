<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createPost = new Permission();

        $createPost->name         = 'delete-users';
        $createPost->display_name = 'Delete Users'; // optional
// Allow a user to...
        $createPost->description  = "Remove Users from a group"; // optional
        $createPost->save();
    }
}
