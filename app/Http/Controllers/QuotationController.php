<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function simularCotizacion(Vehicle $vehiculo, Request $request){

        if ($request->session()->exists('vehiculo1')) {
        session(['vehiculo2' => $vehiculo]);
        }else{
        session(['vehiculo1' => $vehiculo]);
        }
        return view('quotations.simularCotizacion', compact('vehiculo')); 
     }

     public function cotizar(Request $request){
        if ($request->input('btnAgregar') === 'Agregar otro Vehiculo') {
            session(['accesorios1' => $request->input('accesorios')]);
            $controladorP = new ProductController();
            return $controladorP->catalogo();
        }

        if  ($request->input('btnSimular') === 'Simular Cotizacion') {
            $vehiculos = [];
            $colecAccesorios = [];
            if ($request->session()->exists('vehiculo1')) {
                $vehiculo = session('vehiculo1');
                if ($request->session()->exists('accesorios1')) {
                    array_push($vehiculos, $vehiculo);
                    $arr[] = session('accesorios1');
                    $colecAccesorios[$vehiculo->id] = $this->cargaAccesorios($arr);
                }else{
                    session(['accesorios1' => $request->input('accesorios')]);
                    $arr[] = $request->input('accesorios');
                    $colecAccesorios[$vehiculo->id] = $this->cargaAccesorios($arr);

                }
                
            }

            if ($request->session()->exists('vehiculo2')) {
                $vehiculo2 = session('vehiculo2');
                array_push($vehiculos, $vehiculo2);
                session(['accesorios2' =>  $request->input('accesorios')]);
                if (!(empty($request->input('accesorios')))) {
                    $colecAccesorios[$vehiculo2->id] = $this->cargaAccesorios($request->input('accesorios'));    
                }else{
                    $colecAccesorios[$vehiculo2->id] = 0;    
                }

                
            }
           
            return view('quotations.cotizacion', compact('vehiculos', 'colecAccesorios'));
        }
        
         return "error en agregar otro vehiculo";
       //  return view('quotations.cotizacion');
     }
     public function generarCotizacion(){
        
        return view('quotations.miCotizacion');
     }

     public function cargaAccesorios(Array $list){
        $listAcc = [];
        if (!(is_null($list))) {
        foreach ($list as $acc) {
         if (!(is_null($acc))) {
             $unAccesorioObj = Accessory::find($acc)->first();
             array_push($listAcc, $unAccesorioObj);
         }
        }}
        return $listAcc;
     }
}
