<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //User::truncate();
        DB::table('role_user')->truncate();

       $admin = User::create([
    
        	'first_name' => 'Jean Lionel',
        	'user_name'  => 'nijeanlionel',
        	'last_name' =>'Nininahazwe',
        	'email' => 'admin@admin.com', 
        	'password' => Hash::make('admin'),

        ]);


        $versement = User::create([
    
            'first_name' => 'IRADUKUNDA',
            'last_name' =>'Gretta',
            'user_name'  => 'utilisateur',
              
            'email' => 'versement@coopdi.com', 
            'password' => Hash::make('versement'),

        ]);

        $adminRole = Role::where('name','ADMIN')->first();
        $versementRole = Role::where('name','VERSEMENT')->first();
        $retraitRole = Role::where('name','RETRAIT')->first();
        $save_user = Role::where('name','ENREGISTREMENT DES CLIENTS')->first();
        $user_placement = Role::where('name','RETRAIT DES INTERET SUR LES PLACEMENTS')->first();


        $admin->roles()->attach($adminRole);
        $versement->roles()->attach($versementRole);


    }
}
