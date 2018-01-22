<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_cant_create_reply()
    {
        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create();

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_has_an_owner()
    {
        $reply = factory('App\Reply')->create();

        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
