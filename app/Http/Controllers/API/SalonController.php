<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Salon;
use App\Http\Requests\StoreSalonRequest;
use App\Http\Requests\UpdateSalonRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function response;

class SalonController extends Controller
{

    public function createSalon(StoreSalonRequest $request, $cityId): JsonResponse
    {
        try {
            $salon = Salon::create([
                'name' => $request->validated('name'),
                'city_id' => $cityId,
                'status' => 1
            ]);
            return response()->json($salon);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["message" => $exception->getMessage()], 400);
        }
    }

    public function getSalon($cityId, $salonId): JsonResponse
    {
        $city = City::findOrFail($cityId);
        $salon = Salon::findOrFail($salonId);
        if ($salon->status == 1) {
            $responseJson = [
                'id' => $salon->id,
                'name' => $salon->name,
                'city' => $city->only(['id', 'name'])
           ];
       }
       else {
          $responseJson = [
              'code' => '404',
              'message' => 'ID not found'
          ];
      }
      return response()->json($responseJson);
    }

    public function getSalons($cityId): JsonResponse
    {
        $salons = Salon::where('city_id', strval($cityId))->where('status', '=', 1)->get();
        if ($salons->count() > 0) {
            return response()->json($salons);
        } else {
            $responseJson = [
                'code' => '404',
                'message' => 'ID not found'
            ];
            return response()->json($responseJson);
        }
    }

    public function updateSalon(UpdateSalonRequest $request, $cityId, $salonId): JsonResponse
    {
        $city = City::findOrFail($cityId);
        $salon = Salon::findOrFail($salonId);
        if ($city->id == $salon->city_id and $salon->status == 1) {
            $salon->update([
                'name' => $request->validated('name'),
                'city_id' => $cityId,
                'status' => 1
            ]);
            return response()->json($salon);
        } else {
            $responseJson = [
                'code' => '404',
                'message' => 'ID not found'
            ];
            return response()->json($responseJson);
        }
    }

    public function deleteSalon($cityId, $salonId): JsonResponse|Response
    {
        $city = City::findOrFail($cityId);
        $salon = Salon::findOrFail($salonId);
        if ($city->id == $salon->city_id and $salon->status == 1) {
            $salon->update([
                'status' => 0
            ]);
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            $responseJson = [
                'code' => '404',
                'message' => 'ID not found'
            ];
            return response()->json($responseJson);
        }
    }
}
