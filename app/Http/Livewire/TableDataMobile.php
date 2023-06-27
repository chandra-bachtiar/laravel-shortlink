<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shortlink;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class TableDataMobile extends Component
{
    public function render()
    {
        $shortlinks = Shortlink::where('user_id', Auth::id())->where('deleted_at', null)->orderBy('id', 'desc')->paginate(6);
        return view('livewire.table-data-mobile', ['shortlinks' => $shortlinks]);
    }

    public function deleteShortlink($id) {
        $shortlink = Shortlink::find($id);
        $shortlink->delete();
        Alert::success('Delete Succes', 'Deleted');
        return redirect()->route('dashboard');
    }
}
