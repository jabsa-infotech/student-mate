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

    function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'title' => ['required', 'alpha'],
            'description' => ['nullable', 'string'],
            'photo'=>['required','starts_with:http']
        ], [
            'title.required' => "Please enter the title",
            'title.alpha' => "This should be alphabets only"
        ]);

        $feed = new Feed();
        $feed->user_id = 1;
        $feed->title =  $request->title;
        $feed->description =  $request->description;
        $feed->photo =  $request->photo;
        $feed->status = 'PUBLISHED';
        $feed->save();

        return redirect()->back();
    }

    function edit(Feed $feed)
    {
        return view('frontend.feeds.edit', compact('feed'));
    }

    function update(Feed $feed, Request $request)
    {
        // Method 1
        // $feed->title =  $request->title;
        // $feed->description =  $request->description;
        // $feed->photo =  $request->photo;
        // $feed->status = 'PUBLISHED';
        // $feed->save();

        // Method 2
        $feed->update([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $request->photo,
        ]);
        return redirect()->route('frontend.feeds');
    }

    function destroy(Feed $feed)
    {
        //    $feedToDestroy = Feed::find($feed);
        //    $feedToDestroy->delete();

        $feed->delete();
        return redirect()->back();
    }
}
