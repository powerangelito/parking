<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\checkInOut;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class CheckInController extends Controller
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
        try {
            //Validando el request
            $rules = [
                'placas' => 'required|min:7'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $validator->errors();
            }

            $idCar = car::where('placas_vehiculo', $request->get('placas'))->select('id')->firstOrFail();

            //Ingresando request e ingresando fecha y hora de entrada
            $checkIn = new checkInOut();
            $checkIn->id_car = $idCar->id;
            $checkIn->fecha_entrada = Carbon::now()->format('Y-m-d H:i:s');
            $checkIn->save();

            return response([
                'msg' => 'Entrada de vehiculo correctamente',
                'success' => true,
                'data' => [
                    'checkIn' => $checkIn
                ],
                'exceptions' => null,
            ], 200);
        } catch (Exception $e) {
            return response([
                'msg' => 'Error al registra la entrada del vehiculo ' . $request->get("placas"),
                'success' => false,
                'data' => [
                    'msgError' => $e->getFile() . ". Línea de fallo => " . $e->getLine()
                ],
                'exceptions' => [
                    'msgError' => $e->getMessage()
                ],
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(checkIn $checkIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(checkIn $checkIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, checkIn $checkIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(checkIn $checkIn)
    {
        //
    }
}
