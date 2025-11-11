@extends('user.template')

@section('title', 'Tentang Kami')

@section('content')
<div class="obat-container">
    <div class="page-header">
        <h1>Tentang Apotek Sehat Sentosa</h1>
        <p>Sejarah, visi, dan komitmen kami untuk melayani kesehatan masyarakat</p>
    </div>

    <div class="about-section" style="max-width: 900px; margin: 0 auto; line-height: 1.8; color: #475569;">
        
        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <h2 style="color: #0ea5e9; margin-bottom: 1rem;">Sejarah Singkat</h2>
            <p>
                <strong>Apotek Sehat Sentosa</strong> didirikan pada tahun <strong>2012</strong> di Kota Medan oleh sekelompok tenaga farmasi dan praktisi kesehatan 
                yang memiliki visi untuk menyediakan layanan obat dan konsultasi kesehatan yang aman, terjangkau, dan terpercaya bagi masyarakat.  
                Sejak awal berdirinya, Apotek Sehat Sentosa berkomitmen untuk mengutamakan pelayanan yang ramah, cepat, serta menjaga kualitas obat yang dijual.
            </p>
        </div>

        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <h2 style="color: #0ea5e9; margin-bottom: 1rem;">Visi dan Misi</h2>
            <p><strong>Visi:</strong> Menjadi apotek pilihan utama masyarakat dengan pelayanan profesional dan berkualitas tinggi.</p>
            <br>
            <p><strong>Misi:</strong></p>
            <ul style="list-style: disc; margin-left: 1.5rem;">
                <li>Menyediakan obat-obatan yang terjamin mutu, keamanan, dan keasliannya.</li>
                <li>Memberikan pelayanan farmasi yang ramah, informatif, dan profesional.</li>
                <li>Mendukung program pemerintah dalam meningkatkan derajat kesehatan masyarakat.</li>
                <li>Mengedukasi masyarakat mengenai penggunaan obat yang bijak dan aman.</li>
            </ul>
        </div>

        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem;">
            <h2 style="color: #0ea5e9; margin-bottom: 1rem;">Layanan Kami</h2>
            <ul style="list-style: square; margin-left: 1.5rem;">
                <li>Penjualan obat resep dan obat bebas.</li>
                <li>Konsultasi langsung dengan apoteker berpengalaman.</li>
                <li>Pemeriksaan tekanan darah dan kadar gula darah.</li>
                <li>Layanan pembelian obat melalui sistem online dengan pengantaran cepat.</li>
                <li>Program edukasi kesehatan masyarakat setiap bulan.</li>
            </ul>
        </div>

        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <h2 style="color: #0ea5e9; margin-bottom: 1rem;">Komitmen Kami</h2>
            <p>
                Kami percaya bahwa kesehatan adalah investasi terbesar dalam kehidupan.  
                Oleh karena itu, <strong>Apotek Sehat Sentosa</strong> terus berupaya menjaga kepercayaan pelanggan dengan menyediakan pelayanan yang cepat, 
                transparan, dan berorientasi pada kebutuhan pasien.  
                Dengan tim apoteker berpengalaman, sistem informasi modern, serta dukungan dari berbagai distributor resmi, 
                kami bertekad untuk menjadi mitra terbaik dalam menjaga kesehatan Anda dan keluarga.
            </p>
        </div>
    </div>
</div>
@endsection
