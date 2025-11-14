<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminStockController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock::with(['medicine.category']);

        // Search by medicine name
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('medicine', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $stocks = $query->paginate(10);
        
        // Get medicines that don't have stock yet (untuk dropdown di modal create)
        $medicines = Medicine::whereNotIn('id', Stock::pluck('medicine_id'))->get();

        return view('admin.stock.index', compact('stocks', 'medicines'));
    }

    public function show($medicineId)
    {
        try {
            $stock = Stock::with(['medicine.category'])
                ->where('medicine_id', $medicineId)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $stock
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak ditemukan'
            ], 404);
        }
    }

    // Create stock untuk obat baru
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'medicine_id' => 'required|exists:medicines,id|unique:stocks,medicine_id',
                'quantity' => 'required|integer|min:0',
            ], [
                'medicine_id.unique' => 'Obat ini sudah memiliki stok. Gunakan tombol Tambah/Kurangi di tabel.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            DB::beginTransaction();

            try {
                $stock = Stock::create([
                    'medicine_id' => $request->medicine_id,
                    'quantity' => $request->quantity,
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Stok berhasil ditambahkan',
                    'data' => $stock
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Create stock error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan stok'
            ], 500);
        }
    }

    // Add stock (menambah quantity yang sudah ada)
    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'medicine_id' => 'required|exists:medicines,id',
                'quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            try {
                $stock = Stock::where('medicine_id', $request->medicine_id)->firstOrFail();
                
                // Tambah stok
                $stock->quantity += $request->quantity;
                $stock->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Stok berhasil ditambahkan',
                    'data' => $stock
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Add stock error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan stok'
            ], 500);
        }
    }

    // Reduce stock (mengurangi quantity yang sudah ada)
    public function reduce(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'medicine_id' => 'required|exists:medicines,id',
                'quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            try {
                $stock = Stock::where('medicine_id', $request->medicine_id)->firstOrFail();

                // Validasi stok mencukupi
                if ($stock->quantity < $request->quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi'
                    ], 400);
                }

                // Kurangi stok
                $stock->quantity -= $request->quantity;
                $stock->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Stok berhasil dikurangi',
                    'data' => $stock
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Reduce stock error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengurangi stok'
            ], 500);
        }
    }
}