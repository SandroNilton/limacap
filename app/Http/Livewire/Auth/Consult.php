<?php

namespace App\Http\Livewire\Auth;

use App\Http\Requests\Auth\LoginRequest;

use App\Models\Procedure;
use Livewire\Component;

class Consult extends Component
{
    public $code;
    public $data;

    protected $rules = [
        'code' => 'required',
    ];

    public function consult()
    {
        $this->validate();
        $data = Procedure::where([['id', '=', $this->code]])->first();
    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.auth.consult');
    }
}
