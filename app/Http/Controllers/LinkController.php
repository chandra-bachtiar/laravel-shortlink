<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shortlink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use RealRashid\SweetAlert\Facades\Alert;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentTime = Carbon::now();
        $hour = $currentTime->hour+7;

        if ($hour >= 0 && $hour < 3) {
            $greeting = 'Selamat Malam';
        } elseif ($hour >= 3 && $hour < 9) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 9 && $hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 21) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }
        $agent = new Agent();
        $isDesktop = $agent->isDesktop();
        $today = Carbon::now();
        $dayName = $today->translatedFormat('l');
        $totalCreated = Shortlink::where('user_id', Auth::id())->where('deleted_at',null)->count();
        $totalClicks = Shortlink::where('user_id', Auth::id())->where('deleted_at',null)->sum('clicks');
        $totalExpired = Shortlink::where('user_id', Auth::id())->where('deleted_at',null)->where('expired', '<', Carbon::now())->count();

        return view('dashboard', compact('greeting', 'dayName' , 'totalCreated', 'totalClicks', 'totalExpired', 'isDesktop'));
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

    public function mobileEdit($id)
    {
        //expired is today + 7
        $expired = Carbon::now()->addDays(6)->format('Y-m-d');
        $url = url('/');
        $link = Shortlink::where('id', $id)->first();
        return view('mobile-edit', compact('expired', 'url', 'link'));
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
            toastr()->success('Link has been created successfully!');
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
            toastr()->success('Link has been created successfully!');
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
    public function edit(Request $request)
    {
        // dd($request->all());
        Shortlink::where('id', $request->id)->update([
            'shorturl' => $request->shorturl,
            'longurl' => $request->longurl,
            'expired' => $request->expired,
            // checking if array request has active key
            'active' => array_key_exists('active', $request->all()) ? true : false,
        ]);
        toastr()->success('Link has been updated!', 'Congrats', ['timeOut' => 2000]);
        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function delete(Request $request)
    {
        // dd($request->all());
        Shortlink::where('id', $request['id-delete'])->update([
            'deleted_at' => Carbon::now(),
        ]);
        toastr()->success('Link has been deleted!', 'Congrats', ['timeOut' => 2000]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
