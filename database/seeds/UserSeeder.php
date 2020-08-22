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
        // Users with profile
        factory(User::class)->times(10)->create()->each(function ($user) {
            factory(UserProfile::class)->create([
                'user_fk' => $user->pk,
            ]);
        });

        // Users without profile
        factory(User::class)->times(10)->create();
    }
}
