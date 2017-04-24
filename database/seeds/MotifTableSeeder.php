<?php

use App\motif;
use Illuminate\Database\Seeder;

class MotifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motif = new motif([
            'reason' => 'Inscription'
        ]);
        $motif->save();

        $motif = new motif([
            'reason' => 'Contribution Mensuelle'
        ]);
        $motif->save();

        $motif = new motif([
            'reason' => 'Pénalités pour retard'
        ]);
        $motif->save();
    }
}
