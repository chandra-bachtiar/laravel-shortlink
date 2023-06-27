<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shortlink;
use Illuminate\Support\Facades\Auth;

class TableData extends Component
{
    public $idurl = 0;
    public $shorturl = '';
    public $longurl = '';
    public $clicks = 0;
    public $active = true;
    public $user_id = 0;
    public $expired = '';
    public $created_at = '';
    public $updated_at = '';
    public $deleted_at = '';
    public $edited = false;
    public $deleted = false;

    public function render()
    {
        $shortlinks = Shortlink::where('user_id', Auth::id())->where('deleted_at', null)->orderBy('id', 'desc')->paginate(6);
        // dd($shortlinks)
        return view('livewire.table-data', ['shortlinks' => $shortlinks]);
    }

    public function modalEdit($link)
    {
        // dd($link);
        $this->edited = true;
        $this->idurl = $link['id'];
        $this->shorturl = $link['shorturl'];
        $this->longurl = $link['longurl'];
        $this->clicks = $link['clicks'];
        $this->active = $link['active'];
        $this->user_id = $link['user_id'];
        $this->expired = $link['expired'];
        $this->created_at = $link['created_at'];
        $this->updated_at = $link['updated_at'];
        $this->deleted_at = $link['deleted_at'];
    }

    public function modalDelete($idurl)
    {
        $this->deleted = true;
        $this->idurl = $idurl;
    }
}
