<?php

namespace App\Events;

use App\Http\Resources\TweetResource;
use App\Models\Tweets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Tweets $tweets;
    /**
     * Create a new event instance.
     */
    public function __construct(Tweets $tweets)
    {

        $this->tweets = $tweets;


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('storeTweet'),
        ];
    }
    public function broadcastAs(): string
    {
        return 'store_tweetss';
    }
    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return ['msg' => TweetResource::make($this->tweets)->resolve() ];
    }
}
