<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffer;
use App\Models\Accessory;
use App\Models\Offer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id', 'updated_at')->paginate();
        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::where('enabled', 1)->where('offer_id', null)->where('removed', 0)->get();
        $accessories = Accessory::where('enabled', 1)->where('offer_id', null)->where('removed', 0)->get();
        return view('offers.create', compact('vehicles', 'accessories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOffer $request)
    {
        /*
        TO DO
        - Manejar error cuando ya existe una oferta con el descuento, inicio y fin ingresados.
        - Redirigir a la vista del administrador
        */
        $offer = Offer::create([
            'discount' => $request->discount,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ]);
        if ($request->vehicles) {
            foreach ($request->vehicles as $vehicle_id) {
                $vehicle = Vehicle::find($vehicle_id);
                $vehicle->offer_id = $offer->id;
                $vehicle->save();
            }
        }
        if ($request->accessories) {
            foreach ($request->accessories as $accessory_id) {
                $accessory = Accessory::find($accessory_id);
                $accessory->offer_id = $offer->id;
                $accessory->save();
            }
        }
        return $offer;
        // return redirect()->route('offers.show', $offer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOffer $request, Offer $offer)
    {
        $offer->update($request->all());
        return redirect()->route('offers.show', $offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return  redirect()->route('offers.index');
    }
}
