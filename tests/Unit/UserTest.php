<?php

namespace Tests\Unit;

use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Puede obtener el perfil de usuario asociado a un usuario.
     */
    function can_get_the_user_profile_associated_to_a_user()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'website' => 'https://styde.net',
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(UserProfile::class, $user->profile);
        $this->assertTrue($userProfile->is($user->profile));
        $this->assertSame('https://styde.net', $user->profile->website);
    }
}
