<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['name'=>'Colin'],[
            'name' => 'Colin',
            'email' => 'colin@uconn.edu',
            'admin' => true,
            'netid' => 'cam13052',
        ]);
        User::updateOrCreate(['name' => 'Courtney'], [
            'name' => 'Courtney',
            'email' => 'courtney.wiley@uconn.edu',
            'admin' => true,
            'netid' => 'caw00004',
        ]);
        User::updateOrCreate(['name' => 'Dan'], [
            'name' => 'Dan',
            'email' => 'daniel.schwartz@uconn.edu',
            'admin' => true,
            'netid' => 'das10009',
        ]);
        User::updateOrCreate(['name' => 'Jack'], [
            'name' => 'Jack',
            'email' => 'jack.dumala@uconn.edu',
            'admin' => true,
            'netid' => 'jdd15104',
        ]);
        factory(User::class, 25)->create();
    }
}
