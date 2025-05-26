<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Floodgate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FloodgateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Not required for this subtask
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request \$request)
    {
        // Not required for this subtask
    }

    /**
     * Display the specified resource.
     */
    public function show(string \$id)
    {
        // Not required for this subtask
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request \$request, string \$id)
    {
        \$validator = Validator::make(\$request->all(), [
            'water_flow_rate' => 'required|numeric',
            'status' => ['required', 'string', Rule::in(['open', 'close'])],
            'pump_status' => ['required', 'string', Rule::in(['open', 'close'])],
        ]);

        if (\$validator->fails()) {
            return response()->json(\$validator->errors(), 422);
        }

        try {
            \$floodgate = Floodgate::find(\$id);

            if (!\$floodgate) {
                return response()->json(['message' => 'Floodgate not found.'], 404);
            }

            \$floodgate->water_flow_rate = \$request->input('water_flow_rate');
            \$floodgate->status = \$request->input('status');
            \$floodgate->pump_status = \$request->input('pump_status');
            \$floodgate->save();

            return response()->json(\$floodgate);

        } catch (\Exception \$e) {
            // Log the error message internally
            // Log::error("Error updating floodgate: " . \$e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the floodgate.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string \$id)
    {
        // Not required for this subtask
    }
}
