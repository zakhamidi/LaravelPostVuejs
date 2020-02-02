<?php

use Illuminate\Database\Seeder;

class PostesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Poste::class, 30)->create();
    }
}
