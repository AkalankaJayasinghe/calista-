<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of materials.
     */
    public function index()
    {
        $materials = Material::where('is_active', true)
            ->orderBy('name')
            ->paginate(20);

        return response()->json($materials);
    }

    /**
     * Display all materials (including inactive) - Admin only.
     */
    public function all()
    {
        $materials = Material::orderBy('name')->paginate(20);

        return response()->json($materials);
    }

    /**
     * Store a newly created material.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:materials,name',
            'type' => 'required|in:wood,metal,fabric,leather,composite,other',
            'description' => 'nullable|string',
            'properties' => 'nullable|json',
            'price_per_unit' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $material = Material::create($request->all());

        return response()->json([
            'message' => 'Material created successfully',
            'data' => $material
        ], 201);
    }

    /**
     * Display the specified material.
     */
    public function show($id)
    {
        $material = Material::findOrFail($id);

        return response()->json($material);
    }

    /**
     * Update the specified material.
     */
    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255|unique:materials,name,' . $id,
            'type' => 'in:wood,metal,fabric,leather,composite,other',
            'description' => 'nullable|string',
            'properties' => 'nullable|json',
            'price_per_unit' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $material->update($request->all());

        return response()->json([
            'message' => 'Material updated successfully',
            'data' => $material
        ]);
    }

    /**
     * Remove the specified material.
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        // Check if material is used in any custom requests
        if ($material->customRequests()->count() > 0) {
            return response()->json([
                'error' => 'Cannot delete material that is used in custom requests'
            ], 400);
        }

        $material->delete();

        return response()->json(['message' => 'Material deleted successfully']);
    }

    /**
     * Get materials by type.
     */
    public function getByType($type)
    {
        $materials = Material::where('type', $type)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return response()->json($materials);
    }
}
