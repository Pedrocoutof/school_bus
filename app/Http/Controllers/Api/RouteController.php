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

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::select(['title as Título', 'id'])->get();
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
            'points.*.title' => 'required|string',
            'points.*.description' => 'required|string',
            'points.*.hour' => 'required',
            'points.*.lat' => 'required',
            'points.*.lng' => 'required',
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

        $routeArray = $route->toArray();
        array_walk_recursive($routeArray, function (&$item) {
            if (is_string($item)) {
                $item = utf8_encode($item);
            }
        });
        return response()->json($routeArray);
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
    public function destroy(string $id)
    {
        //
    }
}
