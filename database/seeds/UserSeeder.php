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
        factory(User::class)->times(100)->create()->each(function ($user) {
            factory(UserProfile::class)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
