<?php

namespace App\Http\Controllers\Back;

use App\Events\StoreTweetEvent;
use App\Events\TweetEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendTweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweets;
use Illuminate\Support\Facades\Redis;

class TweetSendController extends Controller
{
    public function Send(SendTweetRequest $request) : array
    {
        $valid = $request->validated();

        $message = Tweets::create($valid);
        broadcast(new TweetEvent($message))->toOthers();

        return TweetResource::make($message)->resolve();
    }
}
