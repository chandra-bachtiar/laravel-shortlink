<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shortlink;
use Illuminate\Support\Facades\Auth;

class ModalEdit extends Component
{
    public $shorturl;
 
    public function mount()
    {
        $this->shorturl = "test";
    }

    public function openModalEdit($shorturl)
    {
        $this->shorturl = "testing";
    }

    public function render()
    {
        return view('livewire.modal-edit');
    }

   
}
