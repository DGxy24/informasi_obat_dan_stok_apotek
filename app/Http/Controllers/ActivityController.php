<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $type = $request->get('type');
        $days = $request->get('days', 7);

        // Get activities
        $aktivitas = $this->getActivities($type, $days);

        // Paginate
        $perPage = 15;
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        
        $items = $aktivitas->slice($offset, $perPage)->values();
        $total = $aktivitas->count();
        
        $aktivitas = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.activities.index', compact('aktivitas'));
    }

    private function getActivities($type = null, $days = 7)
    {
        $aktivitas = collect();

        // Calculate date range
        if ($days !== 'all') {
            $cutoffDate = Carbon::now()->subDays((int)$days);
        } else {
            $cutoffDate = Carbon::now()->subYears(10); // Get all
        }

        // === Obat baru ditambahkan ===
        if (!$type || $type === 'create') {
            $obatBaru = Medicine::where('created_at', '>=', $cutoffDate)
                ->latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'icon' => '💊',
                        'judul' => "Obat baru ditambahkan",
                        'deskripsi' => "{$item->name} telah ditambahkan ke sistem",
                        'waktu' => $item->created_at,
                        'tipe' => 'create',
                        'user' => 'Admin',
                        'module' => 'Obat'
                    ];
                });
            $aktivitas = $aktivitas->merge($obatBaru);
        }

        // === User baru terdaftar ===
        if (!$type || $type === 'create') {
            $userBaru = User::where('created_at', '>=', $cutoffDate)
                ->latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'icon' => '👤',
                        'judul' => "User baru terdaftar",
                        'deskripsi' => "{$item->name} ({$item->email}) telah mendaftar",
                        'waktu' => $item->created_at,
                        'tipe' => 'create',
                        'user' => $item->name,
                        'module' => 'User'
                    ];
                });
            $aktivitas = $aktivitas->merge($userBaru);
        }

        // === Stok diperbarui ===
        if (!$type || $type === 'update') {
            $stokUpdate = Stock::with('medicine')
                ->where('updated_at', '>=', $cutoffDate)
                ->latest('updated_at')
                ->get()
                ->map(function ($item) {
                    $medicineName = $item->medicine ? $item->medicine->name : "Obat ID {$item->medicine_id}";
                    return [
                        'icon' => '📦',
                        'judul' => "Stok diperbarui",
                        'deskripsi' => "Stok {$medicineName} diperbarui menjadi {$item->quantity}",
                        'waktu' => $item->updated_at,
                        'tipe' => 'update',
                        'user' => 'Admin',
                        'module' => 'Stok'
                    ];
                });
            $aktivitas = $aktivitas->merge($stokUpdate);
        }

        // === Kategori baru ===
        if (!$type || $type === 'create') {
            $kategoriBaru = Category::where('created_at', '>=', $cutoffDate)
                ->latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'icon' => '📁',
                        'judul' => "Kategori baru ditambahkan",
                        'deskripsi' => "Kategori \"{$item->name}\" telah ditambahkan",
                        'waktu' => $item->created_at,
                        'tipe' => 'create',
                        'user' => 'Admin',
                        'module' => 'Kategori'
                    ];
                });
            $aktivitas = $aktivitas->merge($kategoriBaru);
        }

        // === Supplier baru ===
        if (!$type || $type === 'create') {
            $supplierBaru = Supplier::where('created_at', '>=', $cutoffDate)
                ->latest()
                ->get()
                ->map(function ($item) {
                    return [
                        'icon' => '🏢',
                        'judul' => "Supplier baru ditambahkan",
                        'deskripsi' => "{$item->name} telah ditambahkan sebagai supplier",
                        'waktu' => $item->created_at,
                        'tipe' => 'create',
                        'user' => 'Admin',
                        'module' => 'Supplier'
                    ];
                });
            $aktivitas = $aktivitas->merge($supplierBaru);
        }

        // === Obat diupdate ===
        if (!$type || $type === 'update') {
            $obatUpdate = Medicine::where('updated_at', '>=', $cutoffDate)
                ->where('updated_at', '!=', \DB::raw('created_at')) // Only get updates, not creates
                ->latest('updated_at')
                ->get()
                ->map(function ($item) {
                    return [
                        'icon' => '✏️',
                        'judul' => "Data obat diperbarui",
                        'deskripsi' => "Informasi {$item->name} telah diperbarui",
                        'waktu' => $item->updated_at,
                        'tipe' => 'update',
                        'user' => 'Admin',
                        'module' => 'Obat'
                    ];
                });
            $aktivitas = $aktivitas->merge($obatUpdate);
        }

        // Sort by newest first
        return $aktivitas->sortByDesc('waktu')->values();
    }
}