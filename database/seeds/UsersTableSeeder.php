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
        User::updateOrCreate(['name'=>'colinm'],[
            'name' => 'colinm',
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
        factory(User::class, 25)->create();
    }
}
