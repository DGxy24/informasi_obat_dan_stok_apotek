@extends('user.template')

@section('title', 'Lokasi')

@section('content')
    <div class="main-content">
        <div class="obat-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>💊 Daftar Obat</h1>
                <p>Temukan obat yang Anda butuhkan dengan mudah dan cepat</p>
            </div>

            <!-- Search Section -->
            <div class="search-section">
                <form action="{{ route('obat.index') }}" method="GET">
                    <div class="search-box">
                        <input type="text" name="search" placeholder="Cari nama obat..." value="{{ request('search') }}">
                        <button type="submit" class="search-btn">🔍 Cari</button>
                    </div>
                </form>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <button class="filter-btn active" data-filter="all">Semua Obat</button>

                @foreach ($categories as $category)
                    <button class="filter-btn" data-filter="{{ strtolower(str_replace(' ', '-', $category->name)) }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                {{-- {{dd($obats[0]->stocks)}} --}}
                @forelse($obats as $obat)
                    <div class="product-card"
                        data-category="{{ strtolower(str_replace(' ', '-', $obat->category->name)) }}">
                        <div class="product-image">
                            @if ($obat->image)
                                <img src="{{ asset('storage/' . $obat->image) }}" alt="{{ $obat->nama }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                @if (stripos($obat->category->name, 'vitamin') !== false)
                                    🔸
                                @else
                                    💊
                                @endif
                            @endif
                            @php
                                $quantity = optional($obat->stocks)->quantity ?? 0;
                            @endphp
                            @if ($obat->stocks && $obat->stocks->quantity > 50)
                                <span class="product-badge">Tersedia</span>
                            @elseif($obat->stocks && $obat->stocks->quantity > 0)
                                <span class="product-badge low-stock">Stok Terbatas</span>
                            @else
                                <span class="product-badge out-of-stock">Habis</span>
                            @endif

                        </div>
                        <div class="product-info">
                            <div class="product-category">{{ $obat->category->name }}</div>
                            <h3 class="product-name">{{ $obat->name }}</h3>
                            <p class="product-description">{{ Str::limit($obat->description, 100) }}</p>
                            <div class="product-meta">
                                <div class="product-stock">
                                    <span class="stock-icon">📦</span>
                                    <span>Stok: {{ $medicine->stocks->quantity ?? '-' }}</span>
                                </div>
                                <div class="product-price">Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('obat.show', $obat->id) }}" class="btn-detail">Detail</a>

                                @php
                                    $quantity = optional($obat->stocks)->quantity ?? 0;
                                @endphp

                                @if ($quantity > 0)
                                    <button class="btn-add" onclick="addToCart({{ $obat->id }})">+ Keranjang</button>
                                @else
                                    <button class="btn-add" disabled>Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">🔍</div>
                        <h3>Obat Tidak Ditemukan</h3>
                        <p>Maaf, obat yang Anda cari tidak tersedia. Coba kata kunci lain.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($obats->hasPages())
                <div class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($obats->onFirstPage())
                        <span>« Prev</span>
                    @else
                        <a href="{{ $obats->previousPageUrl() }}">« Prev</a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($obats->getUrlRange(1, $obats->lastPage()) as $page => $url)
                        @if ($page == $obats->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($obats->hasMorePages())
                        <a href="{{ $obats->nextPageUrl() }}">Next »</a>
                    @else
                        <span>Next »</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
