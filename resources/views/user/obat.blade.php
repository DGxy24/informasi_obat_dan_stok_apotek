@extends('user.template')

@section('title', 'Daftar Obat')

@section('content')
<div class="obat-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>💊 Daftar Obat</h1>
        <p>Temukan obat yang Anda butuhkan dengan mudah dan cepat</p>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-box">
            <input type="text" placeholder="Cari nama obat...">
            <button class="search-btn">🔍 Cari</button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <button class="filter-btn active" data-filter="all">Semua Obat</button>
        <button class="filter-btn" data-filter="resep">Obat Resep</button>
        <button class="filter-btn" data-filter="bebas">Obat Bebas</button>
        <button class="filter-btn" data-filter="vitamin">Vitamin & Suplemen</button>
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
        {{-- Contoh product card --}}
        <div class="product-card" data-category="resep">
            <div class="product-image">
                💊
                <span class="product-badge">Tersedia</span>
            </div>
            <div class="product-info">
                <div class="product-category">Obat Resep</div>
                <h3 class="product-name">Amoxicillin 500mg</h3>
                <p class="product-description">Antibiotik untuk mengobati berbagai infeksi bakteri.</p>
                <div class="product-meta">
                    <div class="product-stock">
                        <span class="stock-icon">📦</span>
                        <span>Stok: 150</span>
                    </div>
                    <div class="product-price">Rp 25.000</div>
                </div>
                <div class="product-actions">
                    <button class="btn-detail">Detail</button>
                    <button class="btn-add">+ Keranjang</button>
                </div>
            </div>
        </div>

        
        {{-- Tambahkan product card lain di sini --}}
         <!-- Product Card 3 -->
                <div class="product-card" data-category="vitamin">
                    <div class="product-image">
                        🔸
                        <span class="product-badge">Tersedia</span>
                    </div>
                    <div class="product-info">
                        <div class="product-category">Vitamin & Suplemen</div>
                        <h3 class="product-name">Vitamin C 1000mg</h3>
                        <p class="product-description">Suplemen vitamin C untuk meningkatkan daya tahan tubuh dan kesehatan kulit.</p>
                        <div class="product-meta">
                            <div class="product-stock">
                                <span class="stock-icon">📦</span>
                                <span>Stok: 400</span>
                            </div>
                            <div class="product-price">Rp 50.000</div>
                        </div>
                        <div class="product-actions">
                            <button class="btn-detail">Detail</button>
                            <button class="btn-add">+ Keranjang</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card" data-category="resep">
                    <div class="product-image">
                        💊
                        <span class="product-badge">Tersedia</span>
                    </div>
                    <div class="product-info">
                        <div class="product-category">Obat Resep</div>
                        <h3 class="product-name">Metformin 500mg</h3>
                        <p class="product-description">Obat antidiabetes untuk mengontrol kadar gula darah pada penderita diabetes tipe 2.</p>
                        <div class="product-meta">
                            <div class="product-stock">
                                <span class="stock-icon">📦</span>
                                <span>Stok: 200</span>
                            </div>
                            <div class="product-price">Rp 15.000</div>
                        </div>
                        <div class="product-actions">
                            <button class="btn-detail">Detail</button>
                            <button class="btn-add">+ Keranjang</button>
                        </div>
                    </div>
                </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.getAttribute('data-filter');
            productCards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Add to cart demo
    document.querySelectorAll('.btn-add').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!this.disabled) {
                alert('Obat ditambahkan ke keranjang!');
            }
        });
    });
</script>
@endpush
