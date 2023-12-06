<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use App\Models\Proceduremessagefinish;
use Livewire\Component;

class CommentFinish extends Component
{
    public $procedure;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function render()
    {
        $this->comments_finish = Proceduremessagefinish::where([['procedure_id', '=', $this->procedure->id]])->get();
        return view('livewire.admin.procedures.comment-finish');
    }
}
