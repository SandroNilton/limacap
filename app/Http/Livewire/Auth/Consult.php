<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Http\Requests\Auth\LoginRequest;

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
