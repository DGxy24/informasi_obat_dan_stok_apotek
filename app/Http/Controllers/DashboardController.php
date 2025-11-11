<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        // === Total data ===
        $totalUser = User::count();
        $totalObat = Medicine::count();
        $stokRendah = Stock::where('jumlah', '<', 10)->count();

        // === Pertumbuhan User (mingguan) ===
        $now = Carbon::now();
        $startOfThisWeek = $now->copy()->startOfWeek();
        $startOfLastWeek = $startOfThisWeek->copy()->subWeek();
        $endOfLastWeek = $startOfThisWeek->copy()->subSecond();

        $userThisWeek = User::whereBetween('created_at', [$startOfThisWeek, now()])->count();
        $userLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        $persentaseUserBaru = $userLastWeek > 0
            ? (($userThisWeek - $userLastWeek) / $userLastWeek) * 100
            : ($userThisWeek > 0 ? 100 : 0);

        // === Pertumbuhan Obat (bulanan) ===
        $startOfThisMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = (clone $startOfThisMonth)->subMonth();
        $endOfLastMonth = (clone $startOfThisMonth)->subSecond();

        $obatThisMonth = Medicine::whereBetween('created_at', [$startOfThisMonth, now()])->count();
        $obatLastMonth = Medicine::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        $persentaseObat = $obatLastMonth > 0
            ? (($obatThisMonth - $obatLastMonth) / $obatLastMonth) * 100
            : ($obatThisMonth > 0 ? 100 : 0);

        // === Aktivitas terbaru ===
        $aktivitas = collect();

        // Obat baru ditambahkan
        $obatBaru = Medicine::latest()->take(5)->get()->map(function ($item) {
            return [
                'icon' => '💊',
                'judul' => "Obat baru ditambahkan: {$item->name}",
                'waktu' => $item->created_at,
            ];
        });

        // User baru terdaftar
        $userBaru = User::latest()->take(5)->get()->map(function ($item) {
            return [
                'icon' => '👤',
                'judul' => "User baru terdaftar: {$item->name}",
                'waktu' => $item->created_at,
            ];
        });

        // Stok diperbarui
        $stokUpdate = Stock::latest()->take(5)->get()->map(function ($item) {
            return [
                'icon' => '📦',
                'judul' => "Stok diperbarui untuk obat ID {$item->medicine_id}",
                'waktu' => $item->updated_at,
            ];
        });

        // Gabungkan semua aktivitas
        $aktivitas = $aktivitas
            ->merge($obatBaru)
            ->merge($userBaru)
            ->merge($stokUpdate)
            ->sortByDesc('waktu')
            ->take(5);

        return view('admin.dashboard', compact(
            'totalUser',
            'totalObat',
            'stokRendah',
            'persentaseUserBaru',
            'persentaseObat',
            'aktivitas'
        ));
    }
}
