<?php

namespace App\Http\Livewire\Admin\Procedures;

use App\Models\Area;
use App\Models\User;
use App\Models\Procedure;
use App\Models\Procedurehistory;
use App\Mail\ChangeAssigneProcedureMailable;
use App\Mail\ChangeAreaProcedureMailable;
use App\Models\Proceduremessage;
use App\Models\Fileprocedure;
use App\Models\Proceduremessagefinish;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Main extends Component
{
    public $procedure;
    public $procedure_data;

    public $areas, $users, $comments, $files_uploaded, $files_answers, $file_finish, $records, $files_out, $comments_finish;

    public $comment;

    public $files, $description, $state;

    public function mount(Procedure $procedure): void
    {
        $this->procedure = $procedure;
        $this->area = $procedure->area_id;
        $this->user = $procedure->admin_id;
    }

    /* Assignment */
    public function assignArea(): void
    {
        $this->validate(['area' => 'required']);
        if($this->procedure->area_id != $this->area){
            $area = Area::where('id', '=', $this->area)->first();
            $this->procedure->update(['area_id' => $this->area]);
            Procedurehistory::create([
                'procedure_id' => $this->procedure->id,
                'area_id' => $this->area,
                'admin_id' => auth()->user()->id,
                'action' => "El usuario ". auth()->user()->name." asigno al area ".$area->name.".",
                'state' => "Asignado"
            ]);
            $users_area = User::where([['area_id', '=', $this->area]])->get();
            $data = ["idprocedure" => $this->procedure->id, "area" => $area->name, "admin" => auth()->user()->name];
            foreach ($users_area as $user) {
              Mail::to($user->email)->send(new ChangeAreaProcedureMailable($data));
            }
            $this->notice('Se asigno al area correctamente', 'success');
        } else {
            $this->notice('El tramite ya se encuenrta en el área seleccionada actualmente', 'info');
        }
    }

    public function assignUser(): void
    {
        $this->validate(['user' => 'required']);

        if($this->procedure->admin_id != $this->user){
            $user = User::where('id', '=', $this->user)->first();
            if ($user->area != null) {
                $this->procedure->update(['admin_id' => $this->user, 'area_id' => $user->area_id]);
                Procedurehistory::create([
                    'procedure_id' => $this->procedure->id,
                    'area_id' => $user->area_id,
                    'admin_id' => auth()->user()->id,
                    'action' => "El usuario ".auth()->user()->name." asigno al usuario ".$user->name." y paso al area ".$user->area->name,
                    'state' => "Asignado"
                ]);
                $data = ["idprocedure" => $this->procedure->id, "area" => $user->area->name, "user" =>  $user->name, "admin" => auth()->user()->name];
                Mail::to($user->email)->send(new ChangeAssigneProcedureMailable($data));
                $this->notice('Se asigno al usuario correctamente', 'success');
            } else {
                $this->notice('El usuario no tiene un área asignada', 'info');
            }
        } else {
            $this->notice('El tramite ya se encuentra asignado al usuario seleccionado', 'info');
        }
    }

    /* Chat */
    public function addComment(): void
    {
        $this->validate(['comment' => 'required']);
        Proceduremessage::create(['procedure_id' => $this->procedure->id, 'user_id' => auth()->user()->id, 'description' => $this->comment]);
        $this->reset('comment');
    }

    /* FileUploaded */
    public function changeState($formData): void
    {
        $file = Fileprocedure::where('id', '=', $formData['file_id'])->first();
        if($formData['state'] == NULL) {
            $this->notice('El archivo ya cuenta este estado', 'info');
        } else {
            if($file->state == $formData['state']){
                $this->notice('El archivo ya cuenta este estado', 'info');
            } else {
                Fileprocedure::where('id', '=', $formData['file_id'])->update(['state' => $formData['state']]);
                $this->notice('Se actualizo el estado correctamente', 'success');
            }
        }
    }

    /* FileAnswers, FileUploaded, FileFinish */
    public function downloadFile($id, $name, $file)
    {
        $headers = ['Content-Description' => 'File Transfer', 'Content-Type' => Storage::mimeType($name),];
        return Storage::download($file, $name, $headers);
    }

    /* UpdateForm */
    public function assignState(): void
    {
        $this->validate(['state' => 'required', 'description' => 'required']);

        if($this->procedure->state != $this->state){
            $this->procedure->update(['state' => $this->state]);

            Proceduremessagefinish::create([
                'procedure_id' => $this->procedure->id,
                'description' => $this->description,
            ]);

            Procedurehistory::create([
                'procedure_id' => $this->procedure->id,
                'area_id' => $this->procedure->area_id,
                'admin_id' => auth()->user()->id,
                'action' => "El usuario ". auth()->user()->name ." cambio el estado a ". $this->state.".",
                'state' => $this->state
            ]);

            $date = Carbon::now()->format('Y');

            if ($this->files != null) {
                foreach ($this->files as $file) {
                    $path = Storage::put('procedures/'.$date."/".$this->procedure->id."", $file);
                    Fileprocedure::create([
                        'procedure_id' => $this->procedure->id,
                        'requirement_id' => 0,
                        'name' => $file->GetClientOriginalName(),
                        'file' => (string)$path,
                        'state' => $this->state
                    ]);
                }
            }

            $data = ["idprocedure" => $this->procedure->id, "typeprocedure" => $this->procedure->typeprocedure->name, "state" => $this->state];

            Mail::to($this->procedure->user->email)->send(new ChangeStateProcedureMailable($data));

            $this->notice('Se cambio el estado correctamente', 'success');
        } else {
            $this->notice('El tramite ya se encuentra con el estado seleccionado actualmente', 'info');
        }
    }

    public function render()
    {
        $this->procedure_data = Procedure::where([['id', '=', $this->procedure->id]])->first();
        $this->areas = Area::where('state', '=', "Activo")->get();
        $this->users = User::where('state', '=', "Activo")->where('type', '=', "Usuario")->get();
        $this->comments = Proceduremessage::where('procedure_id', '=', $this->procedure_data->id)->orderBy('created_at', 'desc')->get();
        $this->files_uploaded = Fileprocedure::where([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Sin verificar"]])->orWhere([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Aceptado"]])->orWhere([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Rechazado"]])->get();
        $this->files_answers = Fileprocedure::where([['procedure_id', '=', $this->procedure_data->id], ['state', '!=', "Sin verificar"], ['state', '!=', "Aceptado"], ['state', '!=', "Rechazado"], ['state', '!=', "Aprobado"], ['state', '!=', "Cancelado"]])->get();
        $this->files_finish = Fileprocedure::where([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Aprobado"]])->orWhere([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Cancelado"]])->get();
        $this->records = Procedurehistory::where([['procedure_id', '=',  $this->procedure_data->id]])->get();
        $this->files_out = Fileprocedure::where([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Sin verificar"]])->orWhere([['procedure_id', '=', $this->procedure_data->id], ['state', '=', "Rechazado"]])->get();
        $this->comments_finish = Proceduremessagefinish::where([['procedure_id', '=', $this->procedure_data->id]])->get();
        return view('livewire.admin.procedures.main');
    }
}
