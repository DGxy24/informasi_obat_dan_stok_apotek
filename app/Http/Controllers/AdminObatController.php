<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminObatController extends Controller
{
    /**
     * Display a listing of medicines (Admin)
     */
    public function index(Request $request)
    {
        try {
            $categories = Category::all();
            $query = Medicine::query();

            // Search functionality
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->orWhereHas('category', function ($q2) use ($search) {
                            $q2->where('name', 'LIKE', "%{$search}%");
                        });
                });
            }

            // Filter by kategori (relasi)
            if ($request->has('kategori') && $request->kategori != '') {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', $request->kategori);
                });
            }

            // Order by nama
            $query->orderBy('name', 'asc');

            // Paginate
            $medicines = $query->paginate(10);

            return view('admin.obat.index', compact('medicines', 'categories'));
        } catch (\Exception $e) {
            \Log::error('Medicine index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data obat');
        }
    }


    /**
     * Show the form for creating a new medicine
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('admin.obat.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created medicine
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'generic_name' => 'nullable|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'supplier_id' => 'nullable|exists:suppliers,id',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'unit' => 'required|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'name.required' => 'Nama obat wajib diisi',
                'category_id.required' => 'Kategori wajib dipilih',
                'category_id.exists' => 'Kategori tidak valid',
                'supplier_id.exists' => 'Supplier tidak valid',
                'price.required' => 'Harga wajib diisi',
                'price.numeric' => 'Harga harus berupa angka',
                'unit.required' => 'Satuan wajib diisi',
                'image.image' => 'File harus berupa gambar',
                'image.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {
                $data = [
                    'name' => $request->name,
                    'generic_name' => $request->generic_name,
                    'category_id' => $request->category_id,
                    'supplier_id' => $request->supplier_id,
                    'description' => $request->description,
                    'price' => $request->price,
                    'unit' => $request->unit,
                ];

                // Handle image upload
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->storeAs('medicines', $imageName, 'public');
                    $data['image'] = $imagePath;
                }

                $medicine = Medicine::create($data);

                DB::commit();

                Log::info('Medicine created', [
                    'medicine_id' => $medicine->id,
                    'name' => $medicine->name
                ]);

                return redirect()->route('admin.obat.index')
                    ->with('success', 'Obat berhasil ditambahkan');
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Store medicine database error: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal menyimpan data obat');
            }
        } catch (Exception $e) {
            Log::error('Store medicine error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambah obat');
        }
    }

    /**
     * Display the specified medicine (AJAX for modal)
     */
    public function show($id)
    {
        try {
            $medicine = Medicine::with(['category', 'stocks'])->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $medicine
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Obat tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified medicine (AJAX for modal)
     */
    public function update(Request $request, $id)
    {
        try {
            $medicine = Medicine::findOrFail($id);

            // Validasi
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'generic_name' => 'nullable|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'supplier_id' => 'nullable|exists:suppliers,id',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'unit' => 'required|string|max:50',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            try {
                $data = [
                    'name' => $request->name,
                    'generic_name' => $request->generic_name,
                    'category_id' => $request->category_id,
                    'supplier_id' => $request->supplier_id,
                    'description' => $request->description,
                    'price' => $request->price,
                    'unit' => $request->unit,
                ];

                // PENTING: Cek dengan hasFile untuk AJAX upload
                if ($request->hasFile('image')) {
                    $file = $request->file('image');

                    // Validasi manual file
                    if ($file->isValid()) {
                        // Delete old image if exists
                        if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
                            Storage::disk('public')->delete($medicine->image);
                        }

                        // Store new image
                        $imageName = time() . '_' . $file->getClientOriginalName();
                        $imagePath = $file->storeAs('medicines', $imageName, 'public');
                        $data['image'] = $imagePath;

                        Log::info('Image uploaded', ['path' => $imagePath]);
                    }
                }

                $medicine->update($data);

                DB::commit();

                Log::info('Medicine updated', [
                    'medicine_id' => $medicine->id,
                    'name' => $medicine->name
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Obat berhasil diperbarui'
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Update medicine database error: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data obat: ' . $e->getMessage()
                ], 500);
            }
        } catch (Exception $e) {
            Log::error('Update medicine error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui obat'
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $medicine = Medicine::findOrFail($id);

            DB::beginTransaction();

            try {
                // Delete image if exists
                if ($medicine->gambar) {
                    $imagePath = storage_path('app/public/' . $medicine->gambar);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $medicineName = $medicine->nama;
                $medicine->delete();

                DB::commit();

                Log::info('Medicine deleted', [
                    'medicine_id' => $id,
                    'nama' => $medicineName
                ]);

                return redirect()->route('admin.obat.index')
                    ->with('success', 'Obat berhasil dihapus');
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Delete medicine database error: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Gagal menghapus obat');
            }
        } catch (Exception $e) {
            Log::error('Delete medicine error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus obat');
        }
    }
}
