<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::select(['full_name as Nome completo', 'email as Email', 'phone as Telefone', 'zip_code as CEP'])->get();
        return response()->json($drivers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $driver = Driver::create($validatedData);
            return response()->json($driver, 201);
        } catch (\Exception $e) {

            return response()->json(
                ["error" => "Erro ao salvar o motorista.", "message" => $e->getMessage(), ],
                500
            );

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
