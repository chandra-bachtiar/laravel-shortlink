<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function success(Request $request)
    {
        $shorturl = $request->shorturl;
        $diff = $request->diff;
        return view('success', compact('shorturl', 'diff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'long_url' => 'required'
        ]);

        $link = Shortlink::create([
            'shorturl' => Str::random(6),
            'longurl' => $request->long_url,
            'expires_at' => now()->addDays(1),
        ]);
        $shorturl = url('/' . $link->shorturl);
        //compare long_url with short_url
        $diff = strlen($request->long_url) - strlen($shorturl);
        $expired = $link->expires_at;

        return redirect()->route('link.success', compact('shorturl', 'diff', 'expired'));
    }

    public function redirect(string $shorturl)
    {
        //get shortlink from database
        $link = Shortlink::where('shorturl', $shorturl)->first();

        //handle if link is unknown
        if(!$link) {
            return view('404',['message' => 'This link is unknown.']);
        }

        // if($link->expires_at < now()) {
        //     return view('404',['message' => 'This link has expired.']);
        // }

        //increment clicks
        $link->increment('clicks');
        //redirect to long url
        return redirect()->away($link->longurl);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
