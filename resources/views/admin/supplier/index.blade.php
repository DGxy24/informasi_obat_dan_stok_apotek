@extends('admin.template')

@section('title', 'Kelola Supplier')

@section('page-title', 'Kelola Supplier')

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

        .supplier-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .supplier-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .supplier-name {
            font-weight: 600;
            color: #1e293b;
        }

        .supplier-contact {
            font-size: 0.85rem;
            color: #64748b;
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
            max-width: 600px;
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
        <form action="{{ route('admin.supplier.index') }}" method="GET" class="search-filter">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari nama supplier..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn-primary btn-search">
                🔍 Cari
            </button>
        </form>
        <button onclick="openAddModal()" class="btn-primary">
            ➕ Tambah Supplier
        </button>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $index => $supplier)
                    <tr>
                        <td>{{ $suppliers->firstItem() + $index }}</td>
                        <td>
                            <div class="supplier-info">
                                <div class="supplier-icon">🏢</div>
                                <div>
                                    <div class="supplier-name">{{ $supplier->name }}</div>
                                    <div class="supplier-contact">{{ $supplier->contact_person ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $supplier->phone ?? '-' }}</td>
                        <td>{{ Str::limit($supplier->address ?? '-', 50) }}</td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="viewSupplier({{ $supplier->id }})" class="btn-sm btn-view">
                                    👁️ Lihat
                                </button>
                                <button onclick="editSupplier({{ $supplier->id }})" class="btn-sm btn-edit">
                                    ✏️ Edit
                                </button>
                                <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $supplier->name }}?')">
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
                        <td colspan="5" style="text-align: center; padding: 3rem;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                            <h3>Tidak ada data supplier</h3>
                            <p style="color: #64748b;">Supplier yang Anda cari tidak ditemukan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($suppliers->hasPages())
            <div style="display: flex; justify-content: center; padding: 1.5rem; gap: 0.5rem;">
                @if ($suppliers->onFirstPage())
                    <span style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">« Prev</span>
                @else
                    <a href="{{ $suppliers->previousPageUrl() }}"
                        style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">«
                        Prev</a>
                @endif

                @foreach ($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                    @if ($page == $suppliers->currentPage())
                        <span
                            style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border-radius: 8px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($suppliers->hasMorePages())
                    <a href="{{ $suppliers->nextPageUrl() }}"
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
                <h3 class="modal-title">👁️ Detail Supplier</h3>
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
                <h3 class="modal-title">➕ Tambah Supplier</h3>
                <button class="modal-close" onclick="closeModal('addModal')">✕</button>
            </div>
            <form id="addForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Supplier *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Person</label>
                        <input type="text" name="contact_person" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control"></textarea>
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
                <h3 class="modal-title">✏️ Edit Supplier</h3>
                <button class="modal-close" onclick="closeModal('editModal')">✕</button>
            </div>
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">

                    <div class="form-group">
                        <label class="form-label">Nama Supplier *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Person</label>
                        <input type="text" id="edit_contact_person" name="contact_person" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telepon</label>
                        <input type="text" id="edit_phone" name="phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea id="edit_address" name="address" class="form-control"></textarea>
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

        function viewSupplier(id) {
            const modal = document.getElementById('viewModal');
            const modalBody = document.getElementById('viewModalBody');

            modal.classList.add('show');
            modalBody.innerHTML = '<div style="text-align: center;">Loading...</div>';

            fetch(`/admin/supplier/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const supplier = data.data;
                        modalBody.innerHTML = `
                            <div style="text-align: center; margin-bottom: 1.5rem;">
                                <div style="width: 80px; height: 80px; margin: 0 auto; border-radius: 15px; background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                                    🏢
                                </div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Nama Supplier</div>
                                <div class="detail-value">${supplier.name}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Contact Person</div>
                                <div class="detail-value">${supplier.contact_person || '-'}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Telepon</div>
                                <div class="detail-value">${supplier.phone || '-'}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Alamat</div>
                                <div class="detail-value">${supplier.address || '-'}</div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    modalBody.innerHTML = '<div style="color: red; text-align: center;">Error loading data</div>';
                });
        }

        function editSupplier(id) {
            const modal = document.getElementById('editModal');

            fetch(`/admin/supplier/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const supplier = data.data;
                        document.getElementById('edit_id').value = supplier.id;
                        document.getElementById('edit_name').value = supplier.name;
                        document.getElementById('edit_contact_person').value = supplier.contact_person || '';
                        document.getElementById('edit_phone').value = supplier.phone || '';
                        document.getElementById('edit_address').value = supplier.address || '';
                        modal.classList.add('show');
                    } else {
                        alert('Data supplier tidak ditemukan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data supplier.');
                });
        }

        // Handle submit form add
        document.getElementById('addForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('/admin/supplier', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Supplier berhasil ditambahkan');
                    closeModal('addModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal menambahkan supplier'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat menambahkan supplier');
            }
        });

        // Handle submit form edit
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const id = document.getElementById('edit_id').value;
            const formData = new FormData(this);

            try {
                const response = await fetch(`/admin/supplier/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Supplier berhasil diperbarui');
                    closeModal('editModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal mengupdate supplier'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat update supplier');
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