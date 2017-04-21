<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(PermissionSeeder::class);
        //$this->call(UserTableSeeder::class);
        $this->call(groupTableSeeder::class);
        $this->call(usergroupTableSeeder::class);
        /*$this->call('filesTableSeeder');
        $this->call('periodTableSeeder');
        $this->call('contributionTableSeeder');

        $this->call('adsTableSeeder');
        $this->call('ads_has_filesTableSeeder');
        $this->call('ballotTableSeeder');
        $this->call('propositionTableSeeder');
        */
        //Model::reguard();
    }
}
