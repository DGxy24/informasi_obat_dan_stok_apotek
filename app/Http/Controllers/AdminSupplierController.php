<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminSupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('contact_person', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }

        $suppliers = $query->latest()->paginate(10);

        return view('admin.supplier.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $supplier = Supplier::create([
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supplier berhasil ditambahkan',
                'data' => $supplier
            ]);
        } catch (Exception $e) {
            Log::error('Create supplier error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan supplier'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $supplier
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $supplier->update([
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Supplier berhasil diperbarui',
                'data' => $supplier
            ]);
        } catch (Exception $e) {
            Log::error('Update supplier error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui supplier'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            return redirect()->route('admin.supplier.index')
                ->with('success', 'Supplier berhasil dihapus');
        } catch (Exception $e) {
            Log::error('Delete supplier error: ' . $e->getMessage());
            return redirect()->route('admin.supplier.index')
                ->with('error', 'Gagal menghapus supplier');
        }
    }
}
