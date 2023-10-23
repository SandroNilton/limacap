<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Typeprocedure;
use App\Models\Procedure;
use App\Models\Procedurehistory;
use App\Models\Fileprocedure;
use Carbon\Carbon;
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
      $typeprocedure_area = Typeprocedure::where([['id', '=', $request->typeprocedure_id]])->get();

      $procedure = Procedure::create([
        'user_id' => auth()->user()->id,
        'area_id' => $typeprocedure_area[0]->area_id,
        'typeprocedure_id' => $request->typeprocedure_id,
        'admin_id' => NULL,
        'description' => $request->description,
        'date' => Carbon::now(),
        'state' => 'sin asignar'
      ]);
      Procedurehistory::create([
        'procedure_id' => $procedure->id,
        'typeprocedure_id' => $request->typeprocedure_id,
        'area_id' => $typeprocedure_area[0]->area_id,
        'admin_id' => auth()->user()->id,
        'action' => "El usuario ". auth()->user()->name ." registro un nuevo trámite.",
        'state' => 'sin asignar'
      ]);
      $date = Carbon::now()->format('Y');
      foreach ($request['files'] as $file) {
        $file_url = Storage::put('procedures/'.$date.'/'.$procedure->id, $file['file']);
        Fileprocedure::create([
          'procedure_id' => $procedure->id,
          'requirement_id' => $file['id'],
          'name' => $file['file']->GetClientOriginalName(),
          'file' => (string)$file_url,
          'state' => 'sinverificar'
        ]);
      }

      $data = ["idprocedure" => $procedure->id, "typeprocedure" => $typeprocedure_area[0]->name];


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
