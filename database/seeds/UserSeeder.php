<?php

use App\User;
use App\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
            'email' => 'duilio@styde.net',
            'password' => bcrypt('password'),
            'options' => [
                'language' => 'es',
                'theme' => 'dark',
            ],
        ]);

        // Users with profile
        factory(User::class)->times(10)->create()->each(function ($user) {
            factory(UserProfile::class)->create([
                'user_id' => $user->id,
            ]);
        });

        // Users without profile
        factory(User::class)->times(10)->create();
    }
}
