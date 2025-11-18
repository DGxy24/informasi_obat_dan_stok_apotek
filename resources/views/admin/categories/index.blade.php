@extends('admin.template')

@section('title', 'Kelola Kategori')

@section('page-title', 'Kelola Kategori Obat')

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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
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

        .category-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .category-name {
            font-weight: 600;
            color: #1e293b;
        }

        .category-description {
            font-size: 0.85rem;
            color: #64748b;
        }

        .medicine-count {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f0f9ff;
            border-radius: 20px;
            color: #0369a1;
            font-weight: 600;
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

        .btn-view {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn-view:hover {
            background: #bfdbfe;
            transform: translateY(-2px);
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .modal-close {
            background: #f1f5f9;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .modal-close:hover {
            background: #e2e8f0;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 2rem;
        }

        .detail-group {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .detail-value {
            color: #1e293b;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .modal-footer {
            padding: 1.5rem 2rem;
            border-top: 2px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }
    </style>
@endsection

@section('content')
    <div class="page-actions">
        <form action="{{ route('admin.category.index') }}" method="GET" class="search-filter">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari nama kategori..." value="{{ request('search') }}">
            </div>

            <button type="submit" class="btn-primary btn-search">
                🔍 Cari
            </button>
        </form>
        <button onclick="openAddModal()" class="btn-primary">
            ➕ Tambah Kategori
        </button>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jumlah Obat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $index }}</td>
                        <td>
                            <div class="category-info">
                                <div class="category-icon">📁</div>
                                <div>
                                    <div class="category-name">{{ $category->name }}</div>
                                    <div class="category-description">{{ Str::limit($category->description ?? 'Tidak ada deskripsi', 60) }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="medicine-count">
                                💊 {{ $category->medicines_count }} Obat
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="viewCategory({{ $category->id }})" class="btn-sm btn-view">
                                    👁️ Lihat
                                </button>
                                <button onclick="editCategory({{ $category->id }})" class="btn-sm btn-edit">
                                    ✏️ Edit
                                </button>
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}? Semua obat dalam kategori ini akan terpengaruh!')">
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
                        <td colspan="4" style="text-align: center; padding: 3rem;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                            <h3>Tidak ada data kategori</h3>
                            <p style="color: #64748b;">Kategori yang Anda cari tidak ditemukan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($categories->hasPages())
            <div style="display: flex; justify-content: center; padding: 1.5rem; gap: 0.5rem;">
                @if ($categories->onFirstPage())
                    <span style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">« Prev</span>
                @else
                    <a href="{{ $categories->previousPageUrl() }}"
                        style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">«
                        Prev</a>
                @endif

                @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                    @if ($page == $categories->currentPage())
                        <span
                            style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border-radius: 8px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($categories->hasMorePages())
                    <a href="{{ $categories->nextPageUrl() }}"
                        style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">Next
                        »</a>
                @else
                    <span style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">Next »</span>
                @endif
            </div>
        @endif
    </div>

    <!-- Modal View -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">👁️ Detail Kategori</h3>
                <button class="modal-close" onclick="closeModal('viewModal')">✕</button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center">Loading...</div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">➕ Tambah Kategori</h3>
                <button class="modal-close" onclick="closeModal('addModal')">✕</button>
            </div>
            <form id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Kategori *</label>
                        <input type="text" name="name" class="form-control" required placeholder="Contoh: Analgesik">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" placeholder="Deskripsi kategori (opsional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-primary">💾 Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">✏️ Edit Kategori</h3>
                <button class="modal-close" onclick="closeModal('editModal')">✕</button>
            </div>
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">

                    <div class="form-group">
                        <label class="form-label">Nama Kategori *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea id="edit_description" name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.add('show');
        }

        function viewCategory(id) {
            const modal = document.getElementById('viewModal');
            const modalBody = document.getElementById('viewModalBody');

            modal.classList.add('show');
            modalBody.innerHTML = '<div style="text-align: center;">Loading...</div>';

            fetch(`/admin/category/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const category = data.data;
                        modalBody.innerHTML = `
                            <div style="text-align: center; margin-bottom: 1.5rem;">
                                <div style="width: 80px; height: 80px; margin: 0 auto; border-radius: 15px; background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                                    📁
                                </div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Nama Kategori</div>
                                <div class="detail-value">${category.name}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Deskripsi</div>
                                <div class="detail-value">${category.description || 'Tidak ada deskripsi'}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Jumlah Obat</div>
                                <div class="detail-value" style="font-size: 1.3rem; color: #3b82f6; font-weight: 700;">
                                    ${category.medicines_count} Obat
                                </div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Ditambahkan Pada</div>
                                <div class="detail-value">${new Date(category.created_at).toLocaleDateString('id-ID', {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                })}</div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    modalBody.innerHTML = '<div style="color: red; text-align: center;">Error loading data</div>';
                });
        }

        function editCategory(id) {
            const modal = document.getElementById('editModal');

            fetch(`/admin/category/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const category = data.data;
                        document.getElementById('edit_id').value = category.id;
                        document.getElementById('edit_name').value = category.name;
                        document.getElementById('edit_description').value = category.description || '';
                        modal.classList.add('show');
                    } else {
                        alert('Data kategori tidak ditemukan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data kategori.');
                });
        }

        // Handle submit form add
        document.getElementById('addForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('/admin/category', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Kategori berhasil ditambahkan');
                    closeModal('addModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal menambahkan kategori'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat menambahkan kategori');
            }
        });

        // Handle submit form edit
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const id = document.getElementById('edit_id').value;
            const formData = new FormData(this);

            try {
                const response = await fetch(`/admin/category/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Kategori berhasil diperbarui');
                    closeModal('editModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal mengupdate kategori'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat update kategori');
            }
        });

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });
    </script>
@endsection