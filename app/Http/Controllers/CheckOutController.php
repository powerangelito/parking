<?php

namespace App\Http\Controllers;

use App\Models\CheckInOut;
use Illuminate\Http\Request;
use App\Http\Controllers\CarController;
use Carbon\Carbon;
use Validator;

class CheckOutController extends Controller
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

            if (!$idCar) {
                $registro = CheckInOut::where('id_car', $request->get('placas'))->firstOrFail();
                $registro->fecha_salida = Carbon::now()->format('Y-m-d H:i:s');
                $minutos = $registro->fecha_salida->diffInSeconds($registro->fecha_entrada);
                $importe = ($minutos * 1) / 0.5;
                $registro->importe = $importe;
                $registro->save();
            }

            $registro = CheckInOut::where('id_car', $idCar->id)->firstOrFail();
            $registro->fecha_salida = Carbon::now()->format('Y-m-d H:i:s');
            $registro->save();

            return response([
                'msg' => 'Entrada de vehículo correctamente',
                'success' => true,
                'data' => [
                    'checkIn' => $registro
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
