<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignController extends Controller
{
    // Public Design Gallery
    public function index()
    {
        $designs = Design::where('is_public', true)
            ->with('creator')
            ->latest()
            ->paginate(12);

        return view('custom-furniture.designs.index', compact('designs'));
    }

    // මගේ Designs (My Designs Page)
    public function myDesigns()
    {
        $designs = Design::where('created_by', Auth::id())
            ->latest()
            ->paginate(12);

        return view('custom-furniture.designs.my-designs', compact('designs'));
    }

    // අලුත් Design එකක් හදන Form එක
    public function create()
    {
        return view('custom-furniture.designs.create');
    }

    // Design එක Save කිරීම
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'design_images' => 'nullable|file|image', // Simple file validation
        ]);

        // Image Upload Logic here...
        $imagePath = null;
        if($request->hasFile('design_images')) {
            $imagePath = $request->file('design_images')->store('designs', 'public');
        }

        Design::create([
            'created_by' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'style' => $request->style,
            'design_images' => json_encode([$imagePath]), // Array එකක් විදියට save
            'is_public' => $request->has('is_public'),
        ]);

        return redirect()->route('custom-furniture.designs.my-designs')
            ->with('success', 'Design added successfully!');
    }

    public function show($id)
    {
        $design = Design::with('creator')->findOrFail($id);
        $design->increment('view_count');
        
        return view('custom-furniture.designs.show', compact('design'));
    }
}