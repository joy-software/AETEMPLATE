<?php

use App\Motif;
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
        $motif = new Motif([
            'reason' => 'Inscription'
        ]);
        $motif->save();

        $motif = new Motif([
            'reason' => 'Contribution Mensuelle'
        ]);
        $motif->save();

        $motif = new Motif([
            'reason' => 'Pénalités pour retard'
        ]);
        $motif->save();
    }
}
