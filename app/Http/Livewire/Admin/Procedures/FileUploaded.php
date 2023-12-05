<?php

namespace App\Http\Livewire\Admin\Procedures;

use Livewire\Component;

class FileUploaded extends Component
{


  public $procedure, $comment;
  public $comments;

  public function mount(Procedure $procedure): void
  {
      $this->procedure = $procedure;
  }
  
    public function render()
    {
        return view('livewire.admin.procedures.file-uploaded');
    }
}
