<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shortlink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentTime = Carbon::now();
        $hour = $currentTime->hour;

        if ($hour >= 0 && $hour < 12) {
            $greeting = 'Selamat pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = 'Selamat siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Selamat sore';
        } else {
            $greeting = 'Selamat malam';
        }

        $today = Carbon::now();
        $dayName = $today->translatedFormat('l');

        $shortlinks = Shortlink::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(6);
        $totalCreated = Shortlink::where('user_id', Auth::id())->count();
        $totalClicks = Shortlink::where('user_id', Auth::id())->sum('clicks');
        $totalExpired = Shortlink::where('user_id', Auth::id())->where('expired', '<', Carbon::now())->count();

        return view('dashboard', compact('greeting', 'dayName', 'shortlinks' , 'totalCreated', 'totalClicks', 'totalExpired'));
    }

    public function success(Request $request)
    {
        if (Auth::check()) {
            $shorturl = $request->shorturl;
            $diff = $request->diff;
            $expired = $request->expired;
            return view('created', compact('shorturl', 'diff', 'expired'));
        } else {
            $shorturl = $request->shorturl;
            $diff = $request->diff;
            return view('success', compact('shorturl', 'diff'));
        }
    }

    public function createIndex()
    {
        //expired is today + 7
        $expired = Carbon::now()->addDays(6)->format('Y-m-d');
        $url = url('/');
        return view('create', compact('expired', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'long_url' => 'required'
        ]);

        if (Auth::check()) {
            // dd(Auth::id());
            $link = Shortlink::create([
                'shorturl' => $request->custom_url != null ? $request->custom_url : Str::random(6),
                'longurl' => $request->long_url,
                'user_id' => Auth::id(),
                'expired' => $request->expired,
            ]);

            $shorturl = url('/' . $link->shorturl);
            $diff = strlen($request->long_url) - strlen($shorturl);
            $expired = $link->expired;

            return redirect()->route('url.success', compact('shorturl', 'diff', 'expired'));
        } else {
            $link = Shortlink::create([
                'shorturl' => Str::random(6),
                'longurl' => $request->long_url,
                'expired' => Carbon::now()->addDays(1)->format('Y-m-d'),
            ]);

            $shorturl = url('/' . $link->shorturl);
            $diff = strlen($request->long_url) - strlen($shorturl);
            $expired = $link->expired;

            return redirect()->route('link.success', compact('shorturl', 'diff', 'expired'));
        }
    }

    public function redirect(string $shorturl)
    {
        //get shortlink from database
        $link = Shortlink::where('shorturl', $shorturl)->first();

        //handle if link is unknown
        if (!$link) {
            return view('404', ['message' => 'This link is unknown.']);
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
