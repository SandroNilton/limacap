<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\ClientErrorResponseException;

use Livewire\Component;

class Register extends Component
{
  public $selectTypeuser;
  public $optionSelected;
  public $typeuserSelected;
  public $optiontypeuserSelected;
  public $selectTypeCode;

  public $data = [];

  public $code;
  public $keycap;

  public function updatedSelectTypeuser($value)
  {
    $this->optionSelected = $value;
    $this->reset('code');
  }

  public function searchAgremiado(): void
    {

      $response = Http::get('http://4.228.202.241:441/api/Arquitecto/Listar?cap='.$this->code.'&clave='.$this->keycap);
      $collection = json_decode($response);
      $this->data = collect($collection)->all();

      if($this->data['message'] == "found data"){
        $this->data;
      }else{

      }

    }

  public function render()
  {
      return view('livewire.auth.register');
  }
}
