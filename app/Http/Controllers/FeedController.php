<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feeds()
    {
        $feeds = Feed::all(); //select * from feeds
        return view('welcome', compact('feeds'));
    }
}
