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
        $thread = create('App\Thread');

        $reply = create('App\Reply');

        $this->post($thread->path().'/replies', $reply->toArray())
            ->assertRedirect('/login');
    }

    /** @test */
    public function it_has_an_owner()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
