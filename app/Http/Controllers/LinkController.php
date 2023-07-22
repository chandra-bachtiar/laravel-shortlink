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
        /**
         * $currentTime adalah variable yang akan menampung waktu sekarang
         * $hour adalah variable yang akan menampung jam dari waktu sekarang
         */
        $currentTime = Carbon::now();
        $hour = $currentTime->hour + 7;

        /**
         * Melakukan pengecekan waktu sekarang
         */
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

        /**
         * $agent adalah variable yang akan menampung data dari library agent yang berfungsi
         * untuk mengecek apakah user menggunakan device mobile atau desktop
         * 
         * $isDesktop adalah variable yang akan menampung hasil dari pengecekan device
         * $today adalah variable yang akan menampung waktu sekarang
         * $dayName adalah variable yang akan menampung nama hari dari waktu sekarang
         * $totalCreated adalah variable yang akan menampung total shortlink yang sudah dibuat
         * $totalClicks adalah variable yang akan menampung total klik dari semua shortlink yang sudah dibuat
         * $totalExpired adalah variable yang akan menampung total shortlink yang sudah expired
         */
        $agent = new Agent();
        $isDesktop = $agent->isDesktop();
        $today = Carbon::now();
        $dayName = $today->translatedFormat('l');
        $totalCreated = Shortlink::where('user_id', Auth::id())->where('deleted_at', null)->count();
        $totalClicks = Shortlink::where('user_id', Auth::id())->where('deleted_at', null)->sum('clicks');
        $totalExpired = Shortlink::where('user_id', Auth::id())->where('deleted_at', null)->where('expired', '<', Carbon::now())->count();

        /**
         * menampilkan view dashboard dengan mengirimkan data greeting, dayName, totalCreated, totalClicks, totalExpired, isDesktop
         */
        return view('dashboard', compact('greeting', 'dayName', 'totalCreated', 'totalClicks', 'totalExpired', 'isDesktop'));
    }

    public function success(Request $request)
    {
        /**
         *  pengecekan apakah user sudah login atau belum
         */
        if (Auth::check()) {

            /**
             * Jika sudah login maka akan menampilkan view success dengan mengirimkan data shorturl, diff, expired
             * 
             * $shorturl adalah variable yang akan menampung hasil generate atau link pendek yang telah jadi
             * contohnya dari link panjang
             * 
             * $diff adalah variable yang akan menampung hasil perbedaan panjang dari url asli dengan url yang sudah dibuat pendek
             * $expired adalah variable yang akan menampung hasil expired dari shortlink yang sudah dibuat
             *
             */
            $shorturl = $request->shorturl;
            $diff = $request->diff;
            $expired = $request->expired;
            return view('created', compact('shorturl', 'diff', 'expired'));
        } else {
            /**
             * Jika belum login maka akan menampilkan view success dengan mengirimkan data shorturl, diff
             * 
             * $shorturl adalah variable yang akan menampung hasil generate atau link pendek yang telah jadi
             * contohnya dari link panjang
             * 
             * $diff adalah variable yang akan menampung hasil perbedaan panjang dari url asli dengan url yang sudah dibuat pendek
             */
            $shorturl = $request->shorturl;
            $diff = $request->diff;
            return view('success', compact('shorturl', 'diff'));
        }
    }

    public function createIndex()
    {
        /**
         * Pada fungsi ini kita akan menampilkan view create dengan mengirimkan data expired dan url
         * 
         * $expired adalah variable yang akan menampung hasil expired dari shortlink yang sudah dibuat
         * $url adalah variable yang akan menampung url dari website yang sedang diakses
         */
        $expired = Carbon::now()->addDays(6)->format('Y-m-d');
        $url = url('/');

        /**
         * menampilkan view create dengan mengirimkan data expired dan url
         */
        return view('create', compact('expired', 'url'));
    }

    public function mobileEdit($id)
    {
        /**
         * Pada fungsi ini kita akan menampilkan view mobile-edit dengan mengirimkan data expired, url, dan link
         * 
         * $expired adalah variable yang akan menampung hasil expired dari shortlink yang sudah dibuat
         * $url adalah variable yang akan menampung url dari website yang sedang diakses
         * $link adalah variable yang akan menampung data dari shortlink yang akan diedit
         */
        $expired = Carbon::now()->addDays(6)->format('Y-m-d');
        $url = url('/');
        $link = Shortlink::where('id', $id)->first();

        /**
         * menampilkan view mobile-edit dengan mengirimkan data expired, url, dan link
         */
        return view('mobile-edit', compact('expired', 'url', 'link'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //fungsi untuk memvalidasi bahwa request dengan key long_url harus terisi jika tidak terisi maka error
        $this->validate($request, [
            'long_url' => 'required'
        ]);

        //pengecekan untuk yang sudah login dan belum login
        if (Auth::check()) {

            //proses memasukan data ke database
            /**
             * shorturl = link pendek yang akan tergenerate
             * longurl = link panjang yang akan digantikan oleh link pendek
             * user_id = id dari user yang sudah login dan membuat shortlink
             * expired = waktu expired dari shortlink tersebut
             * 
             * Str::random(6) = untuk membuat karakter random dengan panjang 6 karakter contohnya yusjsk
             */
            $link = Shortlink::create([
                /**
                 * pada short url ada kondisi dimana jika request->custom_url itu tidak di isi maka akan tergenerate otomatis oleh fungsi str random 6
                 * namun jika ada isinya maka akan mengambil dari custom url yang di input oleh user.
                 */
                'shorturl' => $request->custom_url != null ? $request->custom_url : Str::random(6),
                'longurl' => $request->long_url,
                /**
                 * Auth::id() mengambil id dari service yang sudah disediakan oleh laravel dan juga brezee
                 */
                'user_id' => Auth::id(),
                'expired' => $request->expired,
            ]);

            /**
             * $shorturl adalah variable yang akan menampung hasil generate atau link pendek yang telah jadi 
             * contohnya dari link panjang
             */
            $shorturl = url('/' . $link->shorturl);
            // menghitng perbedaan panjang dari url asli dengan url yang sudah dibuat pendek
            $diff = strlen($request->long_url) - strlen($shorturl);
            // mengambil expired dari database
            $expired = $link->expired;
            // menampilkan pesan sukses
            toastr()->success('Link has been created successfully!');
            // redirect ke halaman success
            return redirect()->route('url.success', compact('shorturl', 'diff', 'expired'));
        } else {
            //proses memasukan data ke database
            /**
             * shorturl = link pendek yang akan tergenerate
             * longurl = link panjang yang akan digantikan oleh link pendek
             * expired = waktu expired dari shortlink tersebut
             * 
             * Str::random(6) = untuk membuat karakter random dengan panjang 6 karakter contohnya yusjsk
             */
            $link = Shortlink::create([
                'shorturl' => Str::random(6),
                'longurl' => $request->long_url,
                'expired' => Carbon::now()->addDays(1)->format('Y-m-d'),
            ]);

            /**
             * $shorturl adalah variable yang akan menampung hasil generate atau link pendek yang telah jadi 
             * contohnya dari link panjang
             */
            $shorturl = url('/' . $link->shorturl);
            // menghitng perbedaan panjang dari url asli dengan url yang sudah dibuat pendek
            $diff = strlen($request->long_url) - strlen($shorturl);
            // mengambil expired dari database
            $expired = $link->expired;
            // menampilkan pesan sukses
            toastr()->success('Link has been created successfully!');
            // redirect ke halaman success
            return redirect()->route('link.success', compact('shorturl', 'diff', 'expired'));
        }
    }

    public function redirect(string $shorturl)
    {
        //mengecek apakah shorturl ada di database
        $link = Shortlink::where('shorturl', $shorturl)->first();

        //mengembalikan view 404 jika shorturl tidak ada di database
        if (!$link) {
            return view('404', ['message' => 'This link is unknown.']);
        }

        //menambahkan jumlah klik
        $link->increment('clicks');
        //redirect ke longurl
        return redirect()->away($link->longurl);
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
        /**
         * update data dengan mengisi deleted_at dengan waktu sekarang
         */
        Shortlink::where('id', $request['id-delete'])->update([
            'deleted_at' => Carbon::now(),
        ]);

        /**
         * menampilkan pesan sukses
         * redirect ke halaman dashboard
         */
        toastr()->success('Link has been deleted!', 'Congrats', ['timeOut' => 2000]);
        return redirect()->route('dashboard');
    }
}
