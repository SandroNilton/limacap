<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Typeprocedure;
use App\Models\Procedure;
use App\Models\Procedurehistory;
use App\Models\Fileprocedure;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\CreateProcedureMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProcedureController extends Controller
{
    public function index()
    {
        return view('app.procedures.index');
    }

    public function create()
    {
        return view('app.procedures.create');
    }

    public function store(Request $request)
    {
      $typeprocedure = Typeprocedure::where([['id', '=', $request->typeprocedure_id]])->first();

      $procedure = Procedure::create([
        'user_id' => auth()->user()->id,
        'area_id' => $typeprocedure->area_id,
        'typeprocedure_id' => $request->typeprocedure_id,
        'admin_id' => NULL,
        'description' => Str::upper($request->description),
        'date' => Carbon::now(),
        'state' => 'Sin asignar'
      ]);
      Procedurehistory::create([
        'procedure_id' => $procedure->id,
        'typeprocedure_id' => $request->typeprocedure_id,
        'area_id' => $typeprocedure->area_id,
        'admin_id' => auth()->user()->id,
        'action' => "El usuario ". auth()->user()->name ." registro un nuevo trámite.",
        'state' => 'Sin asignar'
      ]);
      $date = Carbon::now()->format('Y');
      foreach ($request['files'] as $file) {
        $file_url = Storage::put('procedures/'.$date.'/'.$procedure->id, $file['file']);
        Fileprocedure::create([
          'procedure_id' => $procedure->id,
          'requirement_id' => $file['id'],
          'name' => $file['file']->GetClientOriginalName(),
          'file' => (string)$file_url,
          'state' => 'Sin verificar'
        ]);
      }

      $data = ["idprocedure" => $procedure->id, "typeprocedure" => $typeprocedure->name];


      Mail::to(auth()->user()->email)->send(new CreateProcedureMailable($data));

      return redirect()->route('app.procedures.index')->notice('El trámite se registro correctamente', 'success');
    }

    public function show($procedure)
    {
        return view('app.procedures.show');
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
