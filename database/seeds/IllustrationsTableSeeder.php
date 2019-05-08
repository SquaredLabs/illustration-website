<?php

use Illuminate\Database\Seeder;

class IllustrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Illustration::class, 25)->create();
    }
}
