<?php

namespace App\Http\Controllers;

use App\Models\Apotek;
use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of obat
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        
        $categories = Category::all();
        $query = Medicine::with(['category', 'stocks']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Order by name
        $query->orderBy('name', 'asc');

        // Paginate
        $obats = $query->paginate(12);

        return view('user.obat', compact('obats', 'categories',));
    }

    public function show($id)
    {
        $obat = Medicine::with(['category', 'stocks', 'supplier'])->findOrFail($id);
        return view('user.obat_view', compact('obat'));
    }
}
