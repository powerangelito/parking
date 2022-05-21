<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cars = Car::all();
            return response([
                'msg' => 'Listado de vehículos',
                'success' => false,
                'data' => [
                    'cars' => $cars
                ],
                'exceptions' => null
            ], 200);
        } catch (Exception $e) {
            return response([
                'msg' => 'Error al mostrar listado de vehículos',
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

            //Ingresando request e ingresando fecha y hora de entrada
            $car = new Car();
            $car->placas_automovil = $request->get("placas");
            $car->fecha_entrada = Carbon::now()->format('Y-m-d H:i:s');
            $car->save();

            return response([
                'msg' => 'Entrada de vehículo correctamente',
                'success' => true,
                'data' => [
                    'car' => $car
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

    public static function getIdCarType($placas)
    {
        return Car::where('placas_vehiculo', $placas)->select(['id', 'tipo'])->first();
    }
}
