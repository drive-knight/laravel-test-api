<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Salon;
use App\Http\Requests\StoreSalonRequest;
use App\Http\Requests\UpdateSalonRequest;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery\Exception\BadMethodCallException;
use function response;

    class SalonController extends Controller
{

    public function createSalon(StoreSalonRequest $request, $cityId)
    {
        $salon = Salon::create([
            'name' => $request->name,
            'city_id' => $cityId
        ]);
        return response()->json($salon);
    }

    public function getSalon($cityId, $salonId)
    {
      $city = City::findOrFail($cityId);
      $salon = Salon::findOrFail($salonId);
      $responseJson = [
        'id' => $salon->id,
        'name' => $salon->name,
        'city' => $city->only(['id', 'name'])
      ];
      return response()->json($responseJson);
    }

    public function getSalons($cityId)
    {
        $salons = Salon::where('city_id', strval($cityId))->get();
        return response()->json($salons);
    }

    public function updateSalon(UpdateSalonRequest $request, $cityId, $salonId)
    {
        try {
            $salon = Salon::find($salonId);
            $salon->update([
              'name' => $request->name,
              'city_id' => $cityId
            ]);
            return response()->json($salon);
        } catch (BadMethodCallException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 404);
        }
    }

    public function deleteSalon($cityId, $salonId)
    {
        try {
            $salon = Salon::find($salonId);
            $salon->update([
                'status' => 0
            ]);
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 404);
        }
    }
}
