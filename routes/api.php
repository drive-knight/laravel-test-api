<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonController;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/city/{cityId}/salon/{salonId}', [SalonController::class, 'getSalon'] );
Route::get('/city/{cityId}/salon', [SalonController::class, 'getSalons']);
Route::post('/city/{cityId}/salon', [SalonController::class, 'createSalon']);
Route::put('/city/{cityId}/salon/{salonId}', [SalonController::class, 'updateSalon']);
Route::delete('/city/{cityId}/salon/{salonId}', [SalonController::class, 'deleteSalon']);

Route::get('/salon/city-salon-name', function () {
    return DB::select('select
    CONCAT(c.name, " ", s.name) as city_salon_name
    from cities c
    left join salons s on c.id = s.city_id
    where s.status = 1 ');
});
Route::get('/salon/stock-stats', function () {
    return DB::select('select
    s.name, count(st.model_id)
    from salons s
    left join stock st on s.id = st.salon_id
    where status = 1
    group by s.id
    order by s.name asc ');
});
Route::get('/salon/stock-price', function () {
    return DB::select('select
    s.id, s.name, max(st.price)
    from salons s
    left join stock st on s.id = st.salon_id
    group by s.id ');
});
Route::get('/model/color-stats', function () {
    return DB::select('select
    m.name, c.name, count(st.id) cnt
    from stock st
    left join models m on st.model_id = m.id
    left join colors c on st.color_id = c.id
    group by st.model_id
    having cnt > 10');
});
Route::get('/salon/stock-stats-order', function (){
    return DB::select('select
    s.name, st.cnt
    from salons s
    join (select salon_id, count(model_id) cnt from stock
    group by salon_id) st on s.id = st.salon_id
    where s.status=1
    ORDER BY s.name, st.cnt DESC');
});
