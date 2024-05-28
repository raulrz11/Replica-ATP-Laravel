<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenistasRequest;
use App\Models\Tenista;
use App\Models\Torneo;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TenistasController extends Controller
{
    public function index(Request $request){
        $this->actualizarRanking();
        $this->porcentajesVictoriasDerrotas();
        $tenistas = Tenista::search($request->search)->orderBy('puntos', 'desc')->paginate(20);
        $tenistasTop = Tenista::all()->sortByDesc('puntos');
        return view('tenistas.index')->with('tenistas', $tenistas)->with('tenistasTop', $tenistasTop);
    }

    public function show($id){
        $tenista = Tenista::find($id);
        if (!$tenista){
            throw new NotFoundHttpException('El tenista no existe');
        }

        return view('tenistas.show')->with('tenista', $tenista);
    }

    public function create(){
        $torneo = Torneo::all();
        return view('tenistas.create')->with('torneo', $torneo);
    }

    public function store(TenistasRequest $request){
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $tenista = new Tenista($request->all());
            $fechaNacimiento = Carbon::parse($tenista->fecha_nacimiento);
            $hoy = Carbon::now();
            $edad = $fechaNacimiento->diffInYears($hoy);
            $tenista->edad = round($edad);
            $tenista->save();
            $this->actualizarRanking();
            $this->porcentajesVictoriasDerrotas();
            flash('Tenista creado con éxito.')->success()->important();
            return redirect()->route('tenistas.index');
        }catch (Exception $e){
            flash('Error al crear el tenista' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function edit($id){
        $tenista = Tenista::find($id);
        if (!$tenista){
            throw new NotFoundHttpException('El tenista no existe');
        }

        $torneos = Torneo::all();
        return view('tenistas.edit')
            ->with('tenista', $tenista)->with('torneos', $torneos);

    }

    public function update(TenistasRequest $request, $id){
        try{
            $request->validated();
        }catch (ValidationException $e){
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $tenista = Tenista::find($id);
            $tenista->update($request->all());
            $tenista->save();
            flash('Tenista actualizado con éxito.')->warning()->important();
            return redirect()->route('tenistas.index');
        }catch (Exception $e){
            flash('Error al actualizar el tenista' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function editImage($id)
    {
        $tenista = Tenista::find($id);

        if (!$tenista) {
            throw new NotFoundHttpException('El tenista no existe');
        }
        return view('tenistas.image')->with('tenista', $tenista);
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $tenista = Tenista::find($id);
            if (!$tenista) {
                throw new NotFoundHttpException('El tenista no existe');
            }
            if ($tenista->imagen != Tenista::$IMAGE_DEFAULT && Storage::exists($tenista->imagen)) {
                Storage::delete($tenista->imagen);
            }

            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave = $tenista->nombre .'.'. $extension;

            $fileToSave = '_'.str_ireplace(' ','_',$tenista->nombre). '.' . $extension;
            $tenista->imagen = $imagen->storeAs('tenistas', $fileToSave, 'public'); // Guardamos la imagen en el disco storage/app/public/products
            $tenista->save();

            flash('Imagen del tenista actualizada con éxito.')->warning()->important();
            return redirect()->route('tenistas.index');
        } catch (Exception $e) {
            flash('Error al actualizar el tenista' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id){
        $tenista = Tenista::find($id);
        if (!$tenista){
            throw new NotFoundHttpException('El tenista no existe');
        }

        try {
            if ($tenista->imagen != Tenista::$IMAGE_DEFAULT && Storage::exists($tenista->imagen)) {
                Storage::delete($tenista->imagen);
            }
            $tenista->delete();
            flash('Tenista eliminado con éxito.')->error()->important();
            return redirect()->route('tenistas.index');
        }catch (Exception $e){
            flash('Error al eliminar el tenista' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function actualizarRanking(){
        $lista = Tenista::all();
        $listaOrdenada = $lista->sortByDesc('puntos');
        $ranking = 1;

        foreach ($listaOrdenada as $tenista){
            $tenista->ranking = $ranking;
            if ($tenista->best_ranking == null || $tenista->ranking < $tenista->best_ranking){
                $tenista->best_ranking = $tenista->ranking;
            }
            $tenista->save();
            $ranking++;
        }
    }

    public function porcentajesVictoriasDerrotas(){
        $lista = Tenista::all();
        foreach ($lista as $tenista){
            $totalPartidos = $tenista->victorias + $tenista->derrotas;
            $porcentajeVictorias = ($tenista->victorias / $totalPartidos) * 100;
            $porcentajeDerrotas = 100 - $porcentajeVictorias;
            $tenista->win_lose = number_format($porcentajeVictorias, 2) . '% / ' . number_format($porcentajeDerrotas, 2) . '%';;
            $tenista->save();
        }
    }

    public function downloadPdf($id){
        $tenista = Tenista::find($id);
        if (!$tenista){
            throw new NotFoundHttpException('El tenista no existe');
        }
        $pdf = Pdf::loadView('tenistas.pdf', compact('tenista'));
        return $pdf->stream();
        //return $pdf->download('ficha_tenista.pdf');
    }
}
