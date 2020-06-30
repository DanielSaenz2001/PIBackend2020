<?php

namespace App\Http\Controllers;
use App\EgresadosEscuelas;
use Illuminate\Http\Request;

class EgresadosEscuelasController extends Controller
{
    public function create(Request $request)
    {

        $EgresadosEscuelas = new EgresadosEscuelas();
        $EgresadosEscuelas->egresado_id = $request->egresado_id;
        $EgresadosEscuelas->escuela_id = $request->escuela_id;
        $EgresadosEscuelas->save();
        return response()->json($EgresadosEscuelas);
    }
    public function show($id)
    {
        $EgresadosEscuelas= EgresadosEscuelas::findOrFail($id);
        return response()->json($EgresadosEscuelas);
    }
    public function update(Request $request, $id)
    {
        $EgresadosEscuelas = EgresadosEscuelas::findOrFail($id);
        $EgresadosEscuelas->egresado_id = $request->egresado_id;
        $EgresadosEscuelas->escuela_id = $request->escuela_id;
        $EgresadosEscuelas->save();
        return response()->json($EgresadosEscuelas);
    }
    public function destroy($id)
    {
        EgresadosEscuelas::findOrFail($id)->delete();
    }
}
