@extends('user.template')

@section('title', 'Daftar Obat')

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
                <form action="{{ route('obat.index') }}" method="GET" id="filterForm">
                    <div class="search-box">
                        <input type="text" name="search" placeholder="Cari nama obat..." value="{{ request('search') }}">
                        <button type="submit" class="search-btn">🔍 Cari</button>
                    </div>
                    <input type="hidden" name="category" id="categoryInput" value="{{ request('category') }}">
                </form>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <button class="filter-btn {{ !request('category') ? 'active' : '' }}" onclick="filterCategory('')">
                    Semua Obat
                </button>

                @foreach ($categories as $category)
                    <button class="filter-btn {{ request('category') == $category->id ? 'active' : '' }}" 
                            onclick="filterCategory('{{ $category->id }}')">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="products-grid">
                @forelse($obats as $obat)
                    <div class="product-card">
                        <div class="product-image">
                            @if ($obat->image)
                                <img src="{{ asset('storage/' . $obat->image) }}" alt="{{ $obat->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="font-size: 4rem; display: flex; align-items: center; justify-content: center; height: 100%;">
                                    @if (stripos($obat->category->name, 'vitamin') !== false)
                                        🔸
                                    @else
                                        💊
                                    @endif
                                </div>
                            @endif
                            
                            @php
                                $quantity = optional($obat->stocks)->quantity ?? 0;
                            @endphp
                            
                            @if ($quantity > 50)
                                <span class="product-badge">Tersedia</span>
                            @elseif($quantity > 0)
                                <span class="product-badge low-stock">Stok Terbatas</span>
                            @else
                                <span class="product-badge out-of-stock">Habis</span>
                            @endif
                        </div>
                        
                        <div class="product-info">
                            <div class="product-category">{{ $obat->category->name }}</div>
                            <h3 class="product-name">{{ $obat->name }}</h3>
                            <p class="product-description">{{ Str::limit($obat->description ?? 'Tidak ada deskripsi', 100) }}</p>
                            <div class="product-meta">
                                <div class="product-stock">
                                    <span class="stock-icon">📦</span>
                                    <span>Stok: {{ $quantity }}</span>
                                </div>
                                <div class="product-price">Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="product-actions">
                                <a href="{{ route('obat.show', $obat->id) }}" class="btn-detail">
                                    👁️ Lihat Detail
                                </a>
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
                    @if ($obats->onFirstPage())
                        <span class="disabled">« Prev</span>
                    @else
                        <a href="{{ $obats->appends(request()->query())->previousPageUrl() }}">« Prev</a>
                    @endif

                    @foreach ($obats->getUrlRange(1, $obats->lastPage()) as $page => $url)
                        @if ($page == $obats->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $obats->appends(request()->query())->url($page) }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($obats->hasMorePages())
                        <a href="{{ $obats->appends(request()->query())->nextPageUrl() }}">Next »</a>
                    @else
                        <span class="disabled">Next »</span>
                    @endif
                </div>
            @endif
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
            margin-bottom: 2rem;
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

        .search-section {
            margin-bottom: 2rem;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-box input {
            flex: 1;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .search-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .filter-section {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .filter-btn:hover {
            border-color: #3b82f6;
            background: #f0f9ff;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border-color: #3b82f6;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            position: relative;
            height: 200px;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #10b981;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-badge.low-stock {
            background: #f59e0b;
        }

        .product-badge.out-of-stock {
            background: #ef4444;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-category {
            color: #3b82f6;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-name {
            font-size: 1.2rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .product-description {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .product-stock {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .product-price {
            font-size: 1.3rem;
            color: #10b981;
            font-weight: 700;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-detail {
            flex: 1;
            padding: 0.75rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #64748b;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            color: #475569;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #f0f9ff;
            border-color: #3b82f6;
        }

        .pagination span.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .pagination span.disabled {
            color: #cbd5e1;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .obat-container {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
            }

            .filter-section {
                justify-content: flex-start;
            }
        }
    </style>

    <script>
        function filterCategory(categoryId) {
            // Update hidden input
            document.getElementById('categoryInput').value = categoryId;
            
            // Submit form
            document.getElementById('filterForm').submit();
        }
    </script>
@endsection