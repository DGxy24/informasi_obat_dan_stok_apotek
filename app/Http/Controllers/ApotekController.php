<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apotek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ApotekController extends Controller
{
    public function index()
    {
        // Ambil data apotek (biasanya hanya 1 record)
        $apotek = Apotek::first();

        // Jika belum ada data, buat default
        if (!$apotek) {
            $apotek = Apotek::create([
                'nama_apotek' => 'Apotek Sehat',
                'alamat' => 'Jl. Kesehatan No. 123',
                'telepon' => '021-1234567',
                'email' => 'info@apotek.com',
            ]);
        }

        return view('admin.settings.index', compact('apotek'));
    }

    public function update(Request $request)
    {
        try {
            $apotek = Apotek::first();

            $validator = Validator::make($request->all(), [
                'nama_apotek' => 'required|string|max:255',
                'alamat' => 'required|string',
                'telepon' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'sejarah' => 'nullable|string',
                'visi' => 'nullable|string',
                'misi' => 'nullable|string',
                'layanan' => 'nullable|string',
                'jam_operasional' => 'nullable|string', // SINGLE FIELD
                'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $request->except('logo');

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($apotek->logo && Storage::disk('public')->exists($apotek->logo)) {
                    Storage::disk('public')->delete($apotek->logo);
                }

                // Store new logo
                $logoPath = $request->file('logo')->store('apotek', 'public');
                $data['logo'] = $logoPath;
            }

            $apotek->update($data);

            return redirect()->route('admin.settings.index')
                ->with('success', 'Pengaturan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Update settings error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui pengaturan')
                ->withInput();
        }
    }
}
