<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feeds()
    {
        $feeds = Feed::latest()->where('status', 'PUBLISHED')->get(); //select * from feeds
        return view('frontend.feeds', compact('feeds'));
    }

    function store(Request $request) {
        $feed = new Feed();
        $feed->user_id = 1;
        $feed->title =  $request->title;
        $feed->description =  $request->description;
        $feed->photo =  $request->photo;
        $feed->status = 'PUBLISHED';
        $feed->save();

        return redirect()->back();
    }
}
