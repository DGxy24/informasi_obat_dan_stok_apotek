@extends('user.template')

@section('title', 'Detail Obat')

@section('content')
    <div class="main-content">
        <div class="detail-container">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('obat.index') }}">← Kembali ke Daftar Obat</a>
            </div>

            <!-- Product Detail -->
            <div class="product-detail">
                <!-- Product Image -->
                <div class="product-image-section">
                    <div class="main-image">
                        @if ($obat->image)
                            <img src="{{ asset('storage/' . $obat->image) }}" alt="{{ $obat->name }}">
                        @else
                            <div class="placeholder-image">
                                @if (stripos($obat->category->name, 'vitamin') !== false)
                                    🔸
                                @else
                                    💊
                                @endif
                            </div>
                        @endif
                    </div>
                    
                    @php
                        $quantity = optional($obat->stocks)->quantity ?? 0;
                    @endphp
                    
                    <div class="stock-status-card">
                        @if ($quantity > 50)
                            <div class="status-badge available">
                                <span class="status-icon">✓</span>
                                <span>Stok Tersedia</span>
                            </div>
                            <div class="stock-info">
                                <span class="stock-label">Stok:</span>
                                <span class="stock-value">{{ $quantity }} {{ $obat->unit }}</span>
                            </div>
                        @elseif($quantity > 0)
                            <div class="status-badge limited">
                                <span class="status-icon">⚠️</span>
                                <span>Stok Terbatas</span>
                            </div>
                            <div class="stock-info">
                                <span class="stock-label">Sisa Stok:</span>
                                <span class="stock-value warning">{{ $quantity }} {{ $obat->unit }}</span>
                            </div>
                        @else
                            <div class="status-badge out-of-stock">
                                <span class="status-icon">✗</span>
                                <span>Stok Habis</span>
                            </div>
                            <div class="stock-info">
                                <span class="stock-label">Stok:</span>
                                <span class="stock-value danger">0 {{ $obat->unit }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info-section">
                    <div class="category-badge">{{ $obat->category->name }}</div>
                    
                    <h1 class="product-title">{{ $obat->name }}</h1>
                    
                    @if ($obat->generic_name)
                        <div class="generic-name">
                            <span class="label">Nama Generik:</span>
                            <span class="value">{{ $obat->generic_name }}</span>
                        </div>
                    @endif
                    
                    <div class="price-section">
                        <div class="price-label">Harga</div>
                        <div class="price-value">Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
                        <div class="price-unit">per {{ $obat->unit }}</div>
                    </div>

                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-icon">📋</div>
                            <div class="info-content">
                                <div class="info-label">Kategori</div>
                                <div class="info-value">{{ $obat->category->name }}</div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">📦</div>
                            <div class="info-content">
                                <div class="info-label">Satuan</div>
                                <div class="info-value">{{ ucfirst($obat->unit) }}</div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">💰</div>
                            <div class="info-content">
                                <div class="info-label">Harga Satuan</div>
                                <div class="info-value">Rp {{ number_format($obat->price, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">📊</div>
                            <div class="info-content">
                                <div class="info-label">Ketersediaan</div>
                                <div class="info-value">
                                    @if ($quantity > 50)
                                        <span style="color: #10b981;">Tersedia</span>
                                    @elseif($quantity > 0)
                                        <span style="color: #f59e0b;">Terbatas</span>
                                    @else
                                        <span style="color: #ef4444;">Habis</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($obat->description)
                        <div class="description-section">
                            <h3 class="section-title">📝 Deskripsi Obat</h3>
                            <div class="description-content">
                                {{ $obat->description }}
                            </div>
                        </div>
                    @endif

                    <div class="info-section">
                        <h3 class="section-title">ℹ️ Informasi Tambahan</h3>
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-item-label">Nama Obat:</span>
                                <span class="info-item-value">{{ $obat->name }}</span>
                            </div>
                            @if ($obat->generic_name)
                                <div class="info-item">
                                    <span class="info-item-label">Nama Generik:</span>
                                    <span class="info-item-value">{{ $obat->generic_name }}</span>
                                </div>
                            @endif
                            <div class="info-item">
                                <span class="info-item-label">Kategori:</span>
                                <span class="info-item-value">{{ $obat->category->name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-item-label">Satuan:</span>
                                <span class="info-item-value">{{ ucfirst($obat->unit) }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-item-label">Harga:</span>
                                <span class="info-item-value">Rp {{ number_format($obat->price, 0, ',', '.') }} / {{ $obat->unit }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-item-label">Stok Tersedia:</span>
                                <span class="info-item-value">{{ $quantity }} {{ $obat->unit }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('obat.index') }}" class="btn-back">
                            ← Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .breadcrumb {
            margin-bottom: 2rem;
        }

        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .breadcrumb a:hover {
            color: #2563eb;
            transform: translateX(-5px);
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 3rem;
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .product-image-section {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .main-image {
            width: 100%;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
        }

        .stock-status-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px solid #e2e8f0;
        }

        .status-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-badge.available {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .status-badge.limited {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .status-badge.out-of-stock {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .stock-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stock-label {
            color: #64748b;
            font-weight: 600;
        }

        .stock-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-value.warning {
            color: #f59e0b;
        }

        .stock-value.danger {
            color: #ef4444;
        }

        .product-info-section {
            overflow-y: auto;
        }

        .category-badge {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-title {
            font-size: 2.5rem;
            color: #1e293b;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .generic-name {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f0f9ff;
            border-radius: 10px;
            border-left: 4px solid #3b82f6;
        }

        .generic-name .label {
            font-weight: 600;
            color: #64748b;
        }

        .generic-name .value {
            color: #1e293b;
            font-weight: 600;
        }

        .price-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .price-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .price-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .price-unit {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 15px;
            display: flex;
            gap: 1rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }

        .info-card:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
        }

        .info-icon {
            font-size: 2rem;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }

        .info-value {
            color: #1e293b;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 1.3rem;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .description-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 15px;
            border-left: 4px solid #3b82f6;
        }

        .description-content {
            color: #475569;
            line-height: 1.8;
            font-size: 1rem;
        }

        .info-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 15px;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .info-item-label {
            color: #64748b;
            font-weight: 600;
        }

        .info-item-value {
            color: #1e293b;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-back {
            flex: 1;
            padding: 1rem 2rem;
            background: #f1f5f9;
            color: #475569;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .detail-container {
                padding: 1rem;
            }

            .product-detail {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 1.5rem;
            }

            .product-image-section {
                position: relative;
                top: 0;
            }

            .main-image {
                height: 300px;
            }

            .product-title {
                font-size: 1.8rem;
            }

            .price-value {
                font-size: 2rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection