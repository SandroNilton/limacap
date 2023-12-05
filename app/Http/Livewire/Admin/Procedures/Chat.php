<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Procedure;
use App\Models\Proceduremessage;
use Livewire\Component;

class Chat extends Component
{
    public $procedure, $comment;
    public $comments;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function addComment(): void
    {
        $this->validate(['comment' => 'required']);
        Proceduremessage::create(['procedure_id' => $this->procedure->id, 'user_id' => auth()->user()->id, 'description' => $this->comment]);
        $this->reset('comment');
    }

    public function render()
    {
        $this->comments = Proceduremessage::where('procedure_id', '=', $this->procedure->id)->orderBy('created_at', 'desc')->get();
        return view('livewire.admin.procedures.chat');
    }
}
