<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesUserRequest;
use App\Http\Resources\Message\MessageResourse;
use App\Http\Resources\TweetResource;
use App\Models\Categories;
use App\Models\Messages;
use App\Models\Ruls;
use App\Models\Tweets;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TweetsController extends Controller
{


    public function vue()
    {
        $tweets = Tweets::latest()->get();
        $categories = Categories::all();
        $tweets = TweetResource::collection($tweets)->resolve();
        return inertia('index', compact('tweets', 'categories'));
    }
}
