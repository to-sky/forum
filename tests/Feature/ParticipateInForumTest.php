<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = create('App\User'));

        $thread = create('App\Thread');

        $reply = make('App\Reply');

        $this->post($thread->path().'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
