<?php

namespace App\Http\Livewire\App;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangeAssigneProcedureMailable;

class Index extends Component
{
    /*public function mount(){
      Mail::to("corue@limacap.org")->send(new ChangeAssigneProcedureMailable($data = ["idprocedure" => "1" , "admin" => "prueba", "user" => "test"]));
    }*/

    public function render()
    {
        return view('livewire.app.index');
    }
}
