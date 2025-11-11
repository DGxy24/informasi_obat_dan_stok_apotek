<?php

namespace App\Http\Controllers;

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
        $query = Medicine::with('stocks', 'category');

        // Search dan filter seperti biasa
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->kategori}%");
            });
        }

        $query->orderBy('name', 'asc');

        $obats = $query->paginate(12);

        // 🔥 Tambahkan ini untuk ambil kategori dari tabel categories
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('user.obat', compact('obats', 'categories'));
    }



    /**
     * Display the specified obat (detail)
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Cari obat berdasarkan ID
        $obat = Medicine::findOrFail($id);

        // Get related products (obat dengan kategori yang sama)
        $relatedObats = Medicine::where('kategori', $obat->kategori)
            ->where('id', '!=', $obat->id)
            ->limit(4)
            ->get();

        // Return ke view detail obat
        return view('user.obat-detail', compact('obat', 'relatedObats'));
    }
}
