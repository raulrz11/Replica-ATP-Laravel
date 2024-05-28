<?php

namespace App\Http\Controllers;

use App\Http\Requests\TorneosRequest;
use App\Models\Tenista;
use App\Models\Torneo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TorneosController extends Controller
{

    protected $tenistasController;

    public function __construct(TenistasController $tenistasController)
    {
        $this->tenistasController = $tenistasController;
    }

    public function index(Request $request){
        $torneos = Torneo::search($request->search)->orderBy('secondary_id', 'asc')->paginate(2);
        return view('torneos.index')->with('torneos', $torneos);
    }

    public function show($id){
        $torneo = Torneo::find($id);
        if (!$torneo){
            throw new NotFoundHttpException('El torneo no exixste');
        }

        return view('torneos.show')->with('torneo', $torneo);
    }

    public function create(){
        return view('torneos.create');
    }

    public function store(TorneosRequest $request){
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $torneo = new Torneo($request->all());
            $torneo->save();
            flash('Torneo creado con éxito.')->success()->important();
            return redirect()->route('torneos.index');
        }catch (Exception $e){
            flash('Error al crear el torneo' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function edit($id){
        $torneo = Torneo::find($id);
        if (!$torneo){
            throw new NotFoundHttpException('El torneo no exixste');
        }

        return view('torneos.edit')->with('torneo', $torneo);
    }

    public function update(TorneosRequest $request, $id){
        try{
            $request->validated();
        }catch (ValidationException $e){
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $torneo = Torneo::find($id);
            $torneo->update($request->all());
             $torneo->save();
            flash('Torneo actualizado con éxito.')->warning()->important();
            return redirect()->route('torneos.index');
        }catch (Exception $e){
            flash('Error al actualizar el torneo' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function editImage($id)
    {
        $torneo = Torneo::find($id);

        if (!$torneo) {
            throw new NotFoundHttpException('El torneo  no existe');
        }
        return view('torneos.image')->with('torneo', $torneo);
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $torneo = Torneo::find($id);
            if (!$torneo) {
                throw new NotFoundHttpException('El torneo no existe');
            }
            if ($torneo->imagen != Torneo::$IMAGE_DEFAULT && Storage::exists($torneo->imagen)) {
                Storage::delete($torneo->imagen);
            }

            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave = $torneo->nombre .'.'. $extension;

            $fileToSave = '_'.str_ireplace(' ','_',$torneo->nombre). '.' . $extension;
            $torneo->imagen = $imagen->storeAs('torneos', $fileToSave, 'public'); // Guardamos la imagen en el disco storage/app/public/products
            $torneo->save();

            flash('Imagen del torneo actualizada con éxito.')->warning()->important();
            return redirect()->route('torneos.index');
        } catch (Exception $e) {
            flash('Error al actualizar el torneo' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id){
        $torneo = Torneo::find($id);
        if (!$torneo){
            throw new NotFoundHttpException('El torneotenista no existe');
        }

        try {
            if ($torneo->imagen != Torneo::$IMAGE_DEFAULT && Storage::exists($torneo->imagen)) {
                Storage::delete($torneo->imagen);
            }
            $torneo->delete();
            flash('Torneo eliminado con éxito.')->error()->important();
            return redirect()->route('torneos.index');
        }catch (Exception $e){
            flash('Error al eliminar el torneo' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function inscribirTenista(Request $request, $id){
        try {
            $request->validate([
                'nombre' => 'required|string'
            ]);
        }catch (ValidationException $e){
            return response()->json(['errors' => $e->errors()], 400);
        }

        $nombreTenista = $request->input('nombre');

        $existingTorneo = Torneo::find($id);
        $existingTenista = Tenista::where('nombre', 'ILIKE', $nombreTenista)->first();

        if (!$existingTorneo || !$existingTenista){
            throw new NotFoundHttpException('El torneo o el tenista no existen');
        }

        if ($existingTorneo->tenistas->contains($existingTenista)){
            throw new NotFoundHttpException('El tenista ya esta inscrito al toreno');
        }

        if ($existingTorneo->entradas != 0){
            $existingTenista->torneos()->attach($existingTorneo->secondary_id);
            $existingTorneo->entradas -= 1;
            $existingTorneo->save();
            return redirect()->route('torneos.index');
        }else{
            throw new NotFoundHttpException('No quedan vacantes');
        }
    }

    public function finalizarTorneo($id){
        $existingTorneo = Torneo::find($id);
        $tenistas = $existingTorneo->tenistas->sortBy('altura');

        if (!$existingTorneo){
            throw new NotFoundHttpException('El torneo no existe');
        }

        foreach ($tenistas->take(4) as $index => $tenista){
            $position = $index + 1;
            switch ($existingTorneo->categoria){
                case 'MASTER_1000':
                    $tenista->puntos += 1000 / $position;
                    $tenista->price_money += $existingTorneo->premio / $position;
                    break;
                case 'MASTER_500':
                    $tenista->puntos += 500 / $position;
                    $tenista->price_money += $existingTorneo->premio / $position;
                    break;
                case 'MASTER_250':
                    $tenista->puntos += 250 / $position;
                    $tenista->price_money += $existingTorneo->premio / $position;
                    break;
            }
            $tenista->torneos()->detach($existingTorneo->secondary_id);
            $tenista->save();
        }

        $this->tenistasController->actualizarRanking();
        $existingTorneo->delete();
        return redirect()->route('torneos.index');
    }
}
