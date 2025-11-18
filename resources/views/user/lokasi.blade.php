@extends('user.template')

@section('title', 'Lokasi')

@section('content')
    <div class="obat-container">
        <div class="page-header">
            <h1>📍 Lokasi {{ $apotek->nama_apotek }}</h1>
            <p>Temukan kami dengan mudah dan cepat</p>
        </div>

        <div class="lokasi-section" style="max-width: 800px; margin: 0 auto;">

            <!-- Informasi Lokasi -->
            <div
                style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(59,130,246,0.3); margin-bottom: 2rem; color: white;">
                <h2 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    🏥 {{ $apotek->nama_apotek }}
                </h2>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; gap: 1rem; align-items: start;">
                        <span style="font-size: 1.5rem;">📍</span>
                        <div>
                            <p style="font-weight: 600; margin-bottom: 0.3rem;">Alamat:</p>
                            <p style="white-space: pre-line; line-height: 1.6;">{{ $apotek->alamat }}</p>
                        </div>
                    </div>

                    @if ($apotek->telepon)
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <span style="font-size: 1.5rem;">📞</span>
                            <div>
                                <p style="font-weight: 600; margin-bottom: 0.3rem;">Telepon:</p>
                                <p>{{ $apotek->telepon }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($apotek->email)
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <span style="font-size: 1.5rem;">📧</span>
                            <div>
                                <p style="font-weight: 600; margin-bottom: 0.3rem;">Email:</p>
                                <p>{{ $apotek->email }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jam Operasional -->
            @if ($apotek->jam_operasional)
                <div
                    style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                    <h2 style="color: #0ea5e9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        🕐 Jam Operasional
                    </h2>
                    <div style="background: #f0f9ff; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #0ea5e9;">
                        <div style="white-space: pre-line; color: #475569; line-height: 2; font-size: 1.05rem;">
                            {{ $apotek->jam_operasional }}</div>
                    </div>
                </div>
            @endif

            {{-- <!-- Google Maps (jika ada) -->
            <div
                style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                <h2 style="color: #0ea5e9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    🗺️ Peta Lokasi
                </h2>
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 10px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31911.84911625896!2d98.6656!3d3.5952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMzUnNDIuNyJOIDk4wrAzOSc1Ni4yIkU!5e0!3m2!1sid!2sid!4v1234567890"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p style="margin-top: 1rem; text-align: center; color: #64748b; font-size: 0.9rem;">
                    💡 Klik pada peta untuk membuka di Google Maps
                </p>
            </div> --}}

            <!-- Cara Menuju Apotek -->
            <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <h2 style="color: #0ea5e9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    🚗 Cara Menuju Apotek
                </h2>
                <div style="display: grid; gap: 1.5rem;">
                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #10b981;">
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem; font-size: 1.1rem;">🚌 Transportasi Umum</h3>
                        <p style="color: #475569; line-height: 1.6;">
                            Dapat dijangkau dengan angkutan umum jurusan Terminal Amplas - Pusat Kota.
                            Turun di halte terdekat dan jalan kaki sekitar 2 menit.
                        </p>
                    </div>

                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #f59e0b;">
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem; font-size: 1.1rem;">🏍️ Kendaraan Pribadi</h3>
                        <p style="color: #475569; line-height: 1.6;">
                            Tersedia area parkir yang luas untuk motor dan mobil.
                            Lokasi strategis di pinggir jalan utama, mudah ditemukan.
                        </p>
                    </div>

                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 10px; border-left: 4px solid #3b82f6;">
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem; font-size: 1.1rem;">🚕 Taksi Online</h3>
                        <p style="color: #475569; line-height: 1.6;">
                            Dapat diakses dengan Grab, Gojek, atau taksi online lainnya.
                            Cukup masukkan "{{ $apotek->nama_apotek }}" sebagai tujuan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                @if ($apotek->telepon)
                    <a href="tel:{{ $apotek->telepon }}"
                        style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 1rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); transition: all 0.3s;">
                        📞 Hubungi Kami
                    </a>
                @endif

                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($apotek->alamat) }}" target="_blank"
                    style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 1rem 2rem; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s;">
                    🗺️ Buka di Maps
                </a>
            </div>
        </div>
    </div>

    <style>
        .obat-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #64748b;
            font-size: 1.1rem;
        }

        a[href^="tel:"],
        a[href*="google.com/maps"] {
            transition: transform 0.3s;
        }

        a[href^="tel:"]:hover,
        a[href*="google.com/maps"]:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .obat-container {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .lokasi-section>div {
                padding: 1.5rem !important;
            }
        }
    </style>
@endsection
