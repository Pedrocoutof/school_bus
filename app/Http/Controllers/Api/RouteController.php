<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Route;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use MatanYadaev\EloquentSpatial\Objects\Point;
use mysql_xdevapi\Exception;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$routes = Route::select(['title as Título', 'id', 'description as Descrição'])->get();
        $routes = Route::with('locations')->get();

        $routes->transform(function ($route) {
            return [
                'Titulo' => $route->title,
                'id' => $route->id,
                'Descrição' => $route->description,
                'Primeira parada' => $route->locations->first()['title'],
                'Última parada' => $route->locations->last()['title']
            ];
        });

        return response()->json($routes);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'routeTitle' => 'required',
            'routeDescription' => 'required',
            'points' => 'required|array|min:2',
            'points.*.title' => 'required|string',
            'points.*.description' => 'required|string',
            'points.*.hour' => 'required',
            'points.*.lat' => 'required',
            'points.*.lng' => 'required',
        ], [
            'points' => "Selecione pelo menos dois pontos para criar uma rota.",
            'points.*.lat' => "Selecione o ponto de parada no mapa.",
            'points.*.lng' => "Selecione o ponto de parada no mapa."
        ]);

        DB::beginTransaction();

        try {
            $createdRoute = Route::create([
                'title' => $validatedData['routeTitle'],
                'description' => $validatedData['routeDescription'],
            ]);

            foreach ($validatedData['points'] as $key => $point) {
                $location = Location::create([
                    'title' => $point['title'],
                    'description' => $point['description'],
                    'hour' => $point['hour'],
                    'coordinates' => DB::raw("ST_GeomFromText('POINT(".$point['lng']." ".$point['lat'].")')"),
                ]);

                $createdRoute->locations()->attach($location->id, [
                    'order' => $key,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Rota e pontos criados com sucesso.'], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['error' => 'Erro ao criar rota e pontos.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $route = Route::with('locations')->findOrFail($id);

        return response()->json($route);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        DB::beginTransaction();
        try {
            $locationIds = $route->locations()->pluck('locations.id');

            foreach($locationIds as $locationId) {
                Location::findOrFail($locationId)->delete();
            }

            $route->delete();
            DB::commit();
            return response()->json(null, 204);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Erro ao deletar rota e pontos.'], 500);
    }
    }
}
