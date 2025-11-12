@extends('admin.template')

@section('title', 'Kelola User')

@section('page-title', 'Kelola User')

@section('styles')
<style>
    .page-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .search-filter {
        display: flex;
        gap: 1rem;
        flex: 1;
    }
    
    .search-box {
        flex: 1;
        max-width: 400px;
    }
    
    .search-box input {
        width: 100%;
        padding: 0.8rem 1.2rem;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
    }
    
    .search-box input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .filter-select {
        padding: 0.8rem 1.2rem;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        background: white;
        cursor: pointer;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        white-space: nowrap;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }
    
    .btn-search {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    
    .table-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        background: #f8fafc;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    
    td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #64748b;
    }
    
    tr:hover {
        background: #f8fafc;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
    }
    
    .user-details {
        display: flex;
        flex-direction: column;
    }
    
    .user-name {
        font-weight: 600;
        color: #1e293b;
    }
    
    .user-email {
        font-size: 0.85rem;
        color: #64748b;
    }
    
    .badge {
        padding: 0.35rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    
    .badge-admin {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }
    
    .badge-user {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }
    
    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-weight: 500;
    }
    
    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }
    
    .btn-edit:hover {
        background: #fde68a;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .btn-delete:hover {
        background: #fecaca;
        transform: translateY(-2px);
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        padding: 1.5rem;
        flex-wrap: wrap;
    }
    
    .pagination a,
    .pagination span {
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        background: white;
        color: #475569;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .pagination a:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    .pagination .active {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-filter {
            flex-direction: column;
        }
        
        .search-box {
            max-width: 100%;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-sm {
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="page-actions">
    <form action="{{ route('admin.users.index') }}" method="GET" class="search-filter">
        <div class="search-box">
            <input type="text" name="search" placeholder="Cari nama, email, username..." value="{{ request('search') }}">
        </div>
        <select name="role" class="filter-select" onchange="this.form.submit()">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
        </select>
        <button type="submit" class="btn-primary btn-search">
            🔍 Cari
        </button>
    </form>
    <a href="{{ route('admin.users.create') }}" class="btn-primary">
        ➕ Tambah User
    </a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Username</th>
                    <th>No. HP</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div class="user-details">
                                <span class="user-name">{{ $user->name }}</span>
                                <span class="user-email">{{ $user->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge badge-admin">👑 Admin</span>
                        @else
                            <span class="badge badge-user">👤 User</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-sm btn-edit">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-state-icon">🔍</div>
                            <h3>Tidak ada data user</h3>
                            <p>User yang Anda cari tidak ditemukan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($users->onFirstPage())
            <span>« Prev</span>
        @else
            <a href="{{ $users->previousPageUrl() }}">« Prev</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            @if ($page == $users->currentPage())
                <span class="active">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}">Next »</a>
        @else
            <span>Next »</span>
        @endif
    </div>
    @endif
</div>
@endsection