<?php

use Illuminate\Database\Seeder;
use Mooncascade\Entities\User;

/**
 * Class UsersTableSeeder
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        entity(User::class)->create();
    }
}
