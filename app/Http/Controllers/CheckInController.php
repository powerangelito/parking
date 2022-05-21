<?php

namespace App\Http\Controllers;

use App\Models\checkInOut;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\CarController;

class CheckInController extends Controller
{
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

            $idCar = CarController::getIdCarType($request->get('placas'));

            //Ingresando request e ingresando fecha y hora de entrada
            $checkIn = new CheckInOut();
            $checkIn->id_car = $idCar->id;
            $checkIn->fecha_entrada = Carbon::now()->format('Y-m-d H:i:s');
            $checkIn->save();

            return response([
                'msg' => 'Entrada de vehículo correctamente',
                'success' => true,
                'data' => [
                    'checkIn' => $checkIn
                ],
                'exceptions' => null,
            ], 200);
        } catch (Exception $e) {
            return response([
                'msg' => 'Error al registra la entrada del vehículo ' . $request->get("placas"),
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
}
