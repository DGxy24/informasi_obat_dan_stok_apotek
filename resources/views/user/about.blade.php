@extends('user.template')

@section('title', 'Tentang Kami')

@section('content')
    <div class="obat-container">
        <div class="page-header">
            <h1>Tentang {{ $apotek->nama_apotek }}</h1>
            <p>Sejarah, visi, dan komitmen kami untuk melayani kesehatan masyarakat</p>
        </div>

        <div class="about-section" style="max-width: 900px; margin: 0 auto; line-height: 1.8; color: #475569;">

            @if ($apotek->logo)
                <div style="text-align: center; margin-bottom: 2rem;">
                    <img src="{{ asset('storage/' . $apotek->logo) }}" alt="{{ $apotek->nama_apotek }}"
                        style="max-width: 200px; height: auto; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                </div>
            @endif

            @if ($apotek->sejarah)
                <div
                    style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                    <h2 style="color: #0ea5e9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        📖 Sejarah Singkat
                    </h2>
                    <p style="white-space: pre-line;">{{ $apotek->sejarah }}</p>
                </div>
            @endif

            @if ($apotek->visi || $apotek->misi)
                <div
                    style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                    <h2 style="color: #0ea5e9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        🎯 Visi dan Misi
                    </h2>

                    @if ($apotek->visi)
                        <div style="margin-bottom: 1.5rem;">
                            <p style="font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Visi:</p>
                            <p style="white-space: pre-line;">{{ $apotek->visi }}</p>
                        </div>
                    @endif

                    @if ($apotek->misi)
                        <div>
                            <p style="font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Misi:</p>
                            <div style="white-space: pre-line;">{{ $apotek->misi }}</div>
                        </div>
                    @endif
                </div>
            @endif

            @if ($apotek->layanan)
                <div
                    style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                    <h2 style="color: #0ea5e9; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        💊 Layanan Kami
                    </h2>
                    <div style="white-space: pre-line;">{{ $apotek->layanan }}</div>
                </div>
            @endif

            <div
                style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(14,165,233,0.3); color: white;">
                <h2 style="color: white; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    📍 Informasi Kontak
                </h2>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div>
                        <p
                            style="font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            🏥 Nama Apotek
                        </p>
                        <p>{{ $apotek->nama_apotek }}</p>
                    </div>

                    <div>
                        <p
                            style="font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            📍 Alamat
                        </p>
                        <p style="white-space: pre-line;">{{ $apotek->alamat }}</p>
                    </div>

                    @if ($apotek->telepon)
                        <div>
                            <p
                                style="font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                📞 Telepon
                            </p>
                            <p>{{ $apotek->telepon }}</p>
                        </div>
                    @endif

                    @if ($apotek->email)
                        <div>
                            <p
                                style="font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                📧 Email
                            </p>
                            <p>{{ $apotek->email }}</p>
                        </div>
                    @endif

                    @if ($apotek->jam_operasional)
                        <div style="grid-column: 1 / -1;">
                            <p
                                style="font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                🕐 Jam Operasional
                            </p>
                            <p style="white-space: pre-line;">{{ $apotek->jam_operasional }}</p>
                        </div>
                    @endif
                </div>
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

        .about-section h2 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .obat-container {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .about-section>div {
                padding: 1.5rem !important;
            }
        }
    </style>
@endsection
