<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    // Workshops List Page
    public function index()
    {
        $workshops = Workshop::where('is_verified', true)
            ->where('is_active', true)
            ->with('user')
            ->paginate(12);

        return view('custom-furniture.workshops.index', compact('workshops'));
    }

    // Single Workshop Profile
    public function show($id)
    {
        $workshop = Workshop::with(['user', 'quotations' => function($q) {
            $q->where('status', 'accepted')->limit(5);
        }])->findOrFail($id);

        return view('custom-furniture.workshops.show', compact('workshop'));
    }
}
