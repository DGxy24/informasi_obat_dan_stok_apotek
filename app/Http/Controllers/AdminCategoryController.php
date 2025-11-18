<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('medicines');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $categories = $query->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $category
            ]);

        } catch (Exception $e) {
            Log::error('Create category error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan kategori'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::withCount('medicines')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $category
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:categories,name,' . $id,
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diperbarui',
                'data' => $category
            ]);

        } catch (Exception $e) {
            Log::error('Update category error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui kategori'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::withCount('medicines')->findOrFail($id);
            
            // Check if category has medicines
            if ($category->medicines_count > 0) {
                return redirect()->route('admin.category.index')
                    ->with('error', 'Tidak dapat menghapus kategori yang masih memiliki obat!');
            }

            $category->delete();

            return redirect()->route('admin.category.index')
                ->with('success', 'Kategori berhasil dihapus');

        } catch (Exception $e) {
            Log::error('Delete category error: ' . $e->getMessage());
            return redirect()->route('admin.category.index')
                ->with('error', 'Gagal menghapus kategori');
        }
    }
}