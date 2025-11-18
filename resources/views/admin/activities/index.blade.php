@extends('admin.template')

@section('title', 'Aktivitas Terbaru')

@section('page-title', 'Log Aktivitas Sistem')

@section('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-info h1 {
            font-size: 1.8rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-info p {
            color: #64748b;
        }

        .filter-section {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 0.8rem 1.2rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .btn-refresh {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-refresh:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .activity-timeline {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .timeline-item {
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem;
            border-left: 3px solid #e2e8f0;
            position: relative;
            transition: all 0.3s;
        }

        .timeline-item:hover {
            background: #f8fafc;
            border-left-color: #3b82f6;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 2rem;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e2e8f0;
            transition: all 0.3s;
        }

        .timeline-item:hover::before {
            border-color: #3b82f6;
            background: #3b82f6;
        }

        .timeline-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.5rem;
        }

        .timeline-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.3rem;
        }

        .timeline-description {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .timeline-time {
            color: #94a3b8;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .timeline-meta {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 0.8rem;
            background: #f1f5f9;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #475569;
        }

        .badge-type {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-create {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .badge-update {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .badge-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .empty-state {
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
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-info">
            <h1>📋 Log Aktivitas Sistem</h1>
            <p>Semua aktivitas yang terjadi di sistem apotek</p>
        </div>
    </div>

    <div class="filter-section">
        <form action="{{ route('admin.activities.index') }}" method="GET" style="display: flex; gap: 1rem; flex: 1;">
            <select name="type" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Tipe</option>
                <option value="create" {{ request('type') == 'create' ? 'selected' : '' }}>➕ Tambah Data</option>
                <option value="update" {{ request('type') == 'update' ? 'selected' : '' }}>✏️ Update Data</option>
                <option value="delete" {{ request('type') == 'delete' ? 'selected' : '' }}>🗑️ Hapus Data</option>
            </select>

            <select name="days" class="filter-select" onchange="this.form.submit()">
                <option value="7" {{ request('days', 7) == 7 ? 'selected' : '' }}>7 Hari Terakhir</option>
                <option value="30" {{ request('days') == 30 ? 'selected' : '' }}>30 Hari Terakhir</option>
                <option value="90" {{ request('days') == 90 ? 'selected' : '' }}>90 Hari Terakhir</option>
                <option value="all" {{ request('days') == 'all' ? 'selected' : '' }}>Semua</option>
            </select>
        </form>

        <button onclick="location.reload()" class="btn-refresh">
            🔄 Refresh
        </button>
    </div>

    <div class="activity-timeline">
        @forelse ($aktivitas as $item)
            <div class="timeline-item">
                <div class="timeline-icon">{{ $item['icon'] }}</div>
                <div class="timeline-content">
                    <div class="timeline-header">
                        <div>
                            <div class="timeline-title">{{ $item['judul'] }}</div>
                            @if(isset($item['deskripsi']))
                                <div class="timeline-description">{{ $item['deskripsi'] }}</div>
                            @endif
                        </div>
                        @if(isset($item['tipe']))
                            <span class="badge-type badge-{{ $item['tipe'] }}">
                                @if($item['tipe'] == 'create')
                                    ➕ Tambah
                                @elseif($item['tipe'] == 'update')
                                    ✏️ Update
                                @elseif($item['tipe'] == 'delete')
                                    🗑️ Hapus
                                @else
                                    ℹ️ Info
                                @endif
                            </span>
                        @endif
                    </div>
                    <div class="timeline-time">
                        🕐 {{ $item['waktu']->diffForHumans() }}
                        <span style="color: #cbd5e1;">•</span>
                        {{ $item['waktu']->format('d M Y H:i') }}
                    </div>
                    @if(isset($item['user']) || isset($item['module']))
                        <div class="timeline-meta">
                            @if(isset($item['user']))
                                <span class="meta-badge">👤 {{ $item['user'] }}</span>
                            @endif
                            @if(isset($item['module']))
                                <span class="meta-badge">📦 {{ $item['module'] }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <h3>Tidak Ada Aktivitas</h3>
                <p>Belum ada aktivitas dalam periode yang dipilih</p>
            </div>
        @endforelse
    </div>

    @if (method_exists($aktivitas, 'hasPages') && $aktivitas->hasPages())
        <div class="pagination">
            @if ($aktivitas->onFirstPage())
                <span class="disabled">« Prev</span>
            @else
                <a href="{{ $aktivitas->appends(request()->query())->previousPageUrl() }}">« Prev</a>
            @endif

            @foreach ($aktivitas->getUrlRange(1, $aktivitas->lastPage()) as $page => $url)
                @if ($page == $aktivitas->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $aktivitas->appends(request()->query())->url($page) }}">{{ $page }}</a>
                @endif
            @endforeach

            @if ($aktivitas->hasMorePages())
                <a href="{{ $aktivitas->appends(request()->query())->nextPageUrl() }}">Next »</a>
            @else
                <span class="disabled">Next »</span>
            @endif
        </div>
    @endif
@endsection