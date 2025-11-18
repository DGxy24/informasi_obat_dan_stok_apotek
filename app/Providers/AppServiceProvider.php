<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Models\Apotek;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $apotek = Apotek::first();

        // Jika belum ada data, buat default
        if (!$apotek) {
            $apotek = new Apotek([
                'nama_apotek' => 'Apotek Sehat',
                'alamat' => 'Jl. Kesehatan No. 123',
                'telepon' => '021-1234567',
                'email' => 'info@apotek.com',
            ]);
        }

        View::share('apotek', $apotek);
    }
}
