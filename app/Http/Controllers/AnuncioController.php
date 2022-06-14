<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Imagen;
use Response;
use Storage;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $result = Anuncio::all();
        return response()->json($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create(){
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { //INSERT into POST
        try{
            $anuncio = new Anuncio($request->all());
            $anuncio->save();
            $result =  $anuncio->id;
        }catch(\Exception $e){
            $result = 0;
        }
        return response()->json($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){ //SELECT 1
    
        $result = Anuncio::find($id);
        
        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id){
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $result = 0;
        $objeto = Anuncio::find($id);
        if($objeto != null){
            try{
                $update = $objeto->update($request->all());
                if($update){
                    $result = 1;
                }
            }catch(\Exception $e){
                
            }
            
        }
        
        return response()->json(['rows' => $result], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            Imagen::where('idanuncio', $id)->delete();
            $result = Anuncio::destroy($id);
        }catch(\Exception $e){
            $result = 0;
        }
        return response()->json($result, 200);
          
    }
    
    function subir(Request $request) {
        $input = 'photo';
        if($request->hasFile($input) && $request->file($input)->isValid()) {
            $archivo = $request->file($input);
            
            $idanuncio = $request->id;
            //$nombre = $request->nombre;
            //$descripcion = $request->descripcion;
            
            $nombre = $archivo->getClientOriginalName();
            $tipe = $archivo->getMimeType();
            //ver el valor de tipe y solo aceptar imagenes
            $archivo->storeAs('public/images/', $nombre . $request->id);
            return response()->json(1, 200);
        }
        return response()->json(0, 200);
    }
    
    function subiranuncio(Request $request) {
        $input = 'photo';
        if($request->hasFile($input) && $request->file($input)->isValid()) {
            $archivo = $request->file($input);
            /*
            $idanuncio = $request->idanuncio;
            $nombre = $request->nombre;
            $descripcion = $request->descripcion;
            */
            
            $type = $archivo->getMimeType(); //tipo solo imagen
           
            $id = 0;
            
            
            if(str_contains($type, 'image') && !str_contains($type, 'gif')) {
                
                try{
                    $imagen = new Imagen($request->all());
                    $imagen->save();
                    $id = $imagen->id;
                    $archivo->storeAs('public/images/', $id);
                }catch(\Exception $e){
                }
            }
            return response()->json($id, 200);
            
        }
        return response()->json(0, 200);
    }
    
    function fotos(Request $request, $idanuncio) {
        $imagenes = Imagen::where('idanuncio', $idanuncio)->get();
        return response()->json($imagenes, 200);
    }
    
    
    function foto(Request $request, $id) {
        $imagen = Imagen::find($id);
        $ruta = 'public/images/noimage.jpg';
        if($imagen != null) {
            $ruta = 'public/images/' . $id;
        }
        $mimeType = Storage::mimeType($ruta);
        $response = Response::make(Storage::disk('local')->get($ruta), 200);
        $response->header("Content-Type", $mimeType);
        return $response;
    }
}