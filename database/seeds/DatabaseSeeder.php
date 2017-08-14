<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(AthletesTableSeeder::class);
    }
}
