<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $route = Route::with('locations')->findOrFail($id);
        // Limpa os dados para evitar problemas de codificação
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
