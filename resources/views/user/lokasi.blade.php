@extends('user.template')

@section('title', 'Lokasi')

@section('content')
<div class="obat-container">
    <div class="page-header">
        <h1>Lokasi Apotek Sehat Sentosa</h1>
        <p>Temukan kami dengan mudah dan cepat</p>
    </div>

    <div class="lokasi-section" style="text-align: center; max-width: 800px; margin: 0 auto;">
        <p style="font-size: 1.1rem; color: #475569; line-height: 1.8; margin-bottom: 2rem;">
            Apotek Sehat Sentosa berlokasi di pusat kota Medan, tepatnya di 
            <strong>Jalan Sisingamangaraja No. 45, Medan Kota, Sumatera Utara</strong>.  
            Lokasi kami sangat strategis dan mudah dijangkau, berada di dekat 
            <em>Rumah Sakit Umum Mitra Medika</em> dan <em>Terminal Amplas</em>.  
            Kami menyediakan area parkir yang luas dan akses jalan yang mudah bagi kendaraan roda dua maupun roda empat.
        </p>

        <div style="background: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <h2 style="color: #0ea5e9; margin-bottom: 0.8rem;">Petunjuk Arah</h2>
            <p style="color: #475569; line-height: 1.8;">
                Dari arah <strong>Terminal Amplas</strong>, cukup berkendara sekitar 5 menit ke arah utara 
                menuju Jalan Sisingamangaraja. Apotek kami berada di sisi kanan jalan, 
                tepat di sebelah minimarket Indomaret.  
                Jika datang dari pusat kota Medan, ambil jalur menuju selatan melewati Jalan Juanda 
                hingga bertemu persimpangan besar, lalu belok kiri menuju Jalan Sisingamangaraja.
            </p>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <h2 style="color: #0ea5e9; margin-bottom: 0.8rem;">Jam Operasional</h2>
            <ul style="list-style: none; color: #475569; line-height: 1.8;">
                <li><strong>Senin – Jumat:</strong> 08.00 – 21.00 WIB</li>
                <li><strong>Sabtu:</strong> 08.00 – 20.00 WIB</li>
                <li><strong>Minggu & Hari Libur:</strong> 09.00 – 18.00 WIB</li>
            </ul>
        </div>
    </div>
</div>
@endsection
