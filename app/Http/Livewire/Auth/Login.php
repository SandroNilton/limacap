<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use App\Http\Requests\Auth\LoginRequest;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    protected function rules(){
        return (new LoginRequest)->rules();
    }

    protected $messages = [
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El campo correo electrónico no es válido',
        'password.required' => 'El campo contraseña es obligatorio.',
    ];


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
