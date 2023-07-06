<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $feeds = Feed::latest()->where('status', 'PUBLISHED')->get(); //select * from feeds
        return view('frontend.feeds.index', compact('feeds'));
    }

    function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'title' => ['required', 'alpha'],
            'description' => ['nullable', 'string'],
            'photo' => ['required', 'image', 'mimes:png,jpg']
        ], [
            'title.required' => "Please enter the title",
            'title.alpha' => "This should be alphabets only"
        ]);

        // $feed = new Feed();
        // $feed->user_id = 1;
        // $feed->title =  $request->title;
        // $feed->description =  $request->description;
        // $feed->photo =  $request->photo;
        // $feed->status = 'PUBLISHED';
        // $feed->save();

        $feed = Feed::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $request->photo,
            'status' => 'PUBLISHED'
        ]);

        if ($request->has('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $path = $request->file('photo')->storeAs('feeds', $filename, 'public');

            $feed->update([
                'photo' => $path
            ]);
        }

        return redirect()->back();
    }

    function edit(Feed $feed)
    {
        return view('frontend.feeds.edit', compact('feed'));
    }

    function update(Feed $feed, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'alpha'],
            'description' => ['nullable', 'string'],
            'photo' => ['required', 'image', 'mimes:png,jpg']
        ], [
            'title.required' => "Please enter the title",
            'title.alpha' => "This should be alphabets only"
        ]);

        // Method 1
        // $feed->title =  $request->title;
        // $feed->description =  $request->description;
        // $feed->photo =  $request->photo;
        // $feed->status = 'PUBLISHED';
        // $feed->save();

        // Method 2
        $oldPhoto = $feed->photo;
        $feed->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->has('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $path = $request->file('photo')->storeAs('feeds', $filename, 'public');

            $feed->update([
                'photo' => $path
            ]);

            try {
                unlink('storage/' . $oldPhoto);
            } catch (\Exception $e) {
            }
        }
        return redirect()->route('frontend.feeds.index');
    }

    function destroy(Feed $feed)
    {
        //    $feedToDestroy = Feed::find($feed);
        //    $feedToDestroy->delete();

        $feed->delete();
        return redirect()->back();
    }
}
