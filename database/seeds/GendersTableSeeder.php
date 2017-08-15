<?php

use Illuminate\Database\Seeder;
use Mooncascade\Entities\Gender;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = ['Male', 'Female'];

        $total = count($genders);
        for ($i = 0; $i < $total; $i++) {

            entity(Gender::class)->create(['name' => $genders[$i]]);
        }
    }
}
