<?php

use App\GuiExemple;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // for ($i=0; $i <10 ; $i++) { 
        //     # code...
        //     GuiExemple::create([
        //     "nom" => $this->faker->name,,
        //     "prenom" => $this->faker->name,,
        //     "age" => 10
        // ]);
        // }

        $this->call(RoleSeeder::class);
    }
}
