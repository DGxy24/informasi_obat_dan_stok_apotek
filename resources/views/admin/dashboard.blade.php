@extends('admin.template')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('styles')
    <style>
        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2.5rem;
            border-radius: 20px;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-card h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            opacity: 0.95;
            font-size: 1.1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.8rem;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border-left: 4px solid #e2e8f0;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-card.primary {
            border-left-color: #3b82f6;
        }

        .stat-card.success {
            border-left-color: #10b981;
        }

        .stat-card.warning {
            border-left-color: #f59e0b;
        }

        .stat-card.danger {
            border-left-color: #ef4444;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .stat-card.primary .stat-icon {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .stat-card.danger .stat-icon {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 0.3rem;
        }

        .stat-change {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .stat-change.positive {
            color: #10b981;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        /* Charts and Tables Section */
        .dashboard-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .section-card {
            background: white;
            padding: 1.8rem;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e293b;
        }

        .section-action {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .section-action:hover {
            text-decoration: underline;
        }

        /* Recent Activity */
        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
            background: #f1f5f9;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.2rem;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .action-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.3rem;
        }

        .action-desc {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Chart Placeholder */
        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-section {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="welcome-content">
            <h2>Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p>Berikut adalah ringkasan sistem apotek hari ini</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-header">
                <span class="stat-label">Total Obat</span>
                <div class="stat-icon">💊</div>
            </div>
            <div class="stat-value">{{ $totalObat }}</div>
            <div class="stat-change {{ $persentaseObat >= 0 ? 'positive' : 'negative' }}">
                <span>
                    @if ($persentaseObat > 0)
                        ↑ {{ number_format($persentaseObat, 1) }}%
                    @elseif ($persentaseObat < 0)
                        ↓ {{ number_format(abs($persentaseObat), 1) }}%
                    @else
                        0%
                    @endif
                </span>
                <span>dari bulan lalu</span>
            </div>
        </div>


        <div class="stat-card success">
            <div class="stat-header">
                <span class="stat-label">Total User</span>
                <div class="stat-icon">👥</div>
            </div>
            <div class="stat-value">{{ $totalUser }}</div>
            <div class="stat-change positive">
                <span>
                    @if ($persentaseUserBaru > 0)
                        ↑ {{ number_format($persentaseUserBaru, 1) }}%
                    @elseif ($persentaseUserBaru < 0)
                        ↓ {{ number_format(abs($persentaseUserBaru), 1) }}%
                    @else
                        0%
                    @endif
                </span>
                <span>user baru</span>
            </div>
        </div>


        <div class="stat-card warning">
            <div class="stat-header">
                <span class="stat-label">Stok Rendah</span>
                <div class="stat-icon">📦</div>
            </div>
            <div class="stat-value">{{ $stokRendah }}</div>

            @if ($stokRendah > 15)
                <div class="stat-change negative">
                    <span>⚠️</span>
                    <span>Perlu restock</span>
                </div>
            @else
                <div class="stat-change">
                    <span>✅</span>
                    <span>Masih aman</span>
                </div>
            @endif
        </div>



    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('admin.obat.create') }}" class="action-card">
            <div class="action-icon">➕</div>
            <div class="action-title">Tambah Obat</div>
            <div class="action-desc">Tambah data obat baru</div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="action-card">
            <div class="action-icon">👤</div>
            <div class="action-title">Kelola User</div>
            <div class="action-desc">Manajemen pengguna</div>
        </a>

        <a href="{{ route('admin.reports') }}" class="action-card">
            <div class="action-icon">📊</div>
            <div class="action-title">Lihat Laporan</div>
            <div class="action-desc">Laporan & statistik</div>
        </a>
    </div>

    <!-- Charts and Activity -->

    <div class="section-card">
        <div class="section-header">
            <h3 class="section-title">Aktivitas Terbaru</h3>
            <a href="#" class="section-action">Lihat Semua →</a>
        </div>
        <ul class="activity-list">
            @forelse ($aktivitas as $item)
                <li class="activity-item">
                    <div class="activity-icon">{{ $item['icon'] }}</div>
                    <div class="activity-content">
                        <div class="activity-title">{{ $item['judul'] }}</div>
                        <div class="activity-time">{{ $item['waktu']->diffForHumans() }}</div>
                    </div>
                </li>
            @empty
                <li class="activity-item">
                    <div class="activity-content">
                        <div class="activity-title">Belum ada aktivitas terbaru.</div>
                    </div>
                </li>
            @endforelse
        </ul>

    </div>
    </div>
@endsection
