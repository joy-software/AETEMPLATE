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

        $this->call(UserTableSeeder::class);
        /*$this->call('filesTableSeeder');
        $this->call('periodTableSeeder');
        $this->call('contributionTableSeeder');
        $this->call('groupTableSeeder');
        $this->call('usergroupTableSeeder');
        $this->call('adsTableSeeder');
        $this->call('ads_has_filesTableSeeder');
        $this->call('ballotTableSeeder');
        $this->call('propositionTableSeeder');
        */
        //Model::reguard();
    }
}
