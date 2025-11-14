@extends('admin.template')

@section('title', 'Kelola Obat')

@section('page-title', 'Kelola Obat')

@section('styles')
    <style>
        /* ... (CSS sama seperti users/index.blade.php) ... */
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

        .filter-select {
            padding: 0.8rem 1.2rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            background: white;
            cursor: pointer;
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

        .medicine-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .medicine-image {
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

        .medicine-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .medicine-name {
            font-weight: 600;
            color: #1e293b;
        }

        .medicine-kategori {
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

        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
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

        .detail-image {
            width: 100%;
            max-width: 300px;
            border-radius: 15px;
            margin-top: 0.5rem;
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
        <form action="{{ route('admin.obat.index') }}" method="GET" class="search-filter">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari nama obat..." value="{{ request('search') }}">
            </div>
            <select name="kategori" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}" {{ request('kategori') == $category->name ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn-primary btn-search">
                🔍 Cari
            </button>
        </form>
        <a href="{{ route('admin.obat.create') }}" class="btn-primary">
            ➕ Tambah Obat
        </a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Obat</th>
                    <th>Nama Generik</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicines as $index => $medicine)
                    <tr>
                        <td>{{ $medicines->firstItem() + $index }}</td>
                        <td>
                            <div class="medicine-info">
                                <div class="medicine-image">
                                    @if ($medicine->image)
                                        <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->nama }}">
                                    @else
                                        💊
                                    @endif
                                </div>
                                <div>
                                    <div class="medicine-name">{{ $medicine->name }}</div>
                                    <div class="medicine-kategori">{{ $medicine->category->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $medicine->generic_name ?? '-' }}</td>
                        <td>{{ $medicine->stocks->quantity ?? '-' }}</td>
                        <td>{{ $medicine->price }}</td>
                        <td>{{ $medicine->unit }}</td>
                        <td>
                            @php
                                $quantity = optional($medicine->stocks)->quantity ?? 0;
                            @endphp

                            @if ($quantity > 50)
                                <span class="badge badge-success">✓ Tersedia</span>
                            @elseif ($quantity > 0)
                                <span class="badge badge-warning">⚠️ Stok Rendah</span>
                            @else
                                <span class="badge badge-danger">✗ Habis</span>
                            @endif

                        </td>
                        <td>
                            <div class="action-buttons">
                                @php
                                    $quantity = optional($medicine->stocks)->quantity;
                                @endphp

                                <button onclick="viewMedicine({{ $medicine->id }})" class="btn-sm btn-view"
                                    {{ is_null($quantity) ? 'disabled' : '' }}>
                                    👁️ Lihat
                                </button>
                                <button onclick="editMedicine({{ $medicine->id }})" class="btn-sm btn-edit">
                                    ✏️ Edit
                                </button>
                                <form action="{{ route('admin.obat.destroy', $medicine->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $medicine->nama }}?')">
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
                        <td colspan="7" style="text-align: center; padding: 3rem;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                            <h3>Tidak ada data obat</h3>
                            <p style="color: #64748b;">Obat yang Anda cari tidak ditemukan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($medicines->hasPages())
            <div style="display: flex; justify-content: center; padding: 1.5rem; gap: 0.5rem;">
                @if ($medicines->onFirstPage())
                    <span style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">« Prev</span>
                @else
                    <a href="{{ $medicines->previousPageUrl() }}"
                        style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">«
                        Prev</a>
                @endif

                @foreach ($medicines->getUrlRange(1, $medicines->lastPage()) as $page => $url)
                    @if ($page == $medicines->currentPage())
                        <span
                            style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border-radius: 8px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($medicines->hasMorePages())
                    <a href="{{ $medicines->nextPageUrl() }}"
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
                <h3 class="modal-title">👁️ Detail Obat</h3>
                <button class="modal-close" onclick="closeModal('viewModal')">✕</button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center">Loading...</div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">✏️ Edit Obat</h3>
                <button class="modal-close" onclick="closeModal('editModal')">✕</button>
            </div>
            <form id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">

                    <div class="form-group">
                        <label class="form-label">Nama Obat</label>
                        <input type="text" id="edit_nama" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select id="edit_kategori" name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea id="edit_deskripsi" name="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" id="edit_harga" name="price" class="form-control" required min="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Satuan</label>
                        <input type="text" id="edit_satuan" name="unit" class="form-control" required>
                    </div>


                    <div class="form-group">
                        <label class="form-label">Gambar (Opsional)</label>
                        <input type="file" id="edit_gambar" name="image" class="form-control" accept="image/*">
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
        function viewMedicine(id) {
            const modal = document.getElementById('viewModal');
            const modalBody = document.getElementById('viewModalBody');

            modal.classList.add('show');
            modalBody.innerHTML = '<div style="text-align: center;">Loading...</div>';

            fetch(`/admin/obat/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        const medicine = data.data;
                        const imageHtml = medicine.gambar ?
                            `<img src="/storage/${medicine.gambar}" alt="${medicine.nama}" class="detail-image">` :
                            '<div style="font-size: 4rem;">💊</div>';

                        modalBody.innerHTML = `
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        ${imageHtml}
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Nama Obat</div>
                        <div class="detail-value">${medicine.name}</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Kategori</div>
                        <div class="detail-value">${medicine.category.name}</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Deskripsi</div>
                        <div class="detail-value">${medicine.description}</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Stok</div>
                        <div class="detail-value">${medicine.stocks.quantity} ${medicine.unit}</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Harga</div>
                        <div class="detail-value">Rp ${Number(medicine.price).toLocaleString('id-ID')}</div>
                    </div>
                    ${medicine.expired_date ? `
                                                        <div class="detail-group">
                                                            <div class="detail-label">Tanggal Kadaluarsa</div>
                                                            <div class="detail-value">${new Date(medicine.expired_date).toLocaleDateString('id-ID')}</div>
                                                        </div>
                                                        ` : ''}
                `;
                    }
                })
                .catch(error => {
                    modalBody.innerHTML = '<div style="color: red; text-align: center;">Error loading data</div>';
                });
        }

        function editMedicine(id) {
            const modal = document.getElementById('editModal');

            fetch(`/admin/obat/${id}`)
                .then(async response => {
                    if (!response.ok) {
                        const err = await response.json().catch(() => ({}));
                        console.error('Fetch Error (GET):', err);
                        alert('Gagal mengambil data obat');
                        throw new Error('Fetch GET Error');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const medicine = data.data;
                        document.getElementById('edit_id').value = medicine.id;
                        document.getElementById('edit_nama').value = medicine.nama ?? medicine.name;
                        document.getElementById('edit_deskripsi').value = medicine.deskripsi ?? medicine.description;
                        document.getElementById('edit_harga').value = medicine.harga ?? medicine.price;
                        document.getElementById('edit_satuan').value = medicine.satuan ?? medicine.unit;

                        // Set kategori (old value)
                        const kategoriSelect = document.getElementById('edit_kategori');
                        kategoriSelect.value = medicine.category_id;

                        // Optional field jika ada
                        if (medicine.expired_date) {
                            document.getElementById('edit_expired_date').value = medicine.expired_date;
                        }

                        modal.classList.add('show');
                    } else {
                        alert('Data obat tidak ditemukan.');
                    }
                })
                .catch(err => {
                    console.error('Error saat mengambil data obat:', err);
                    alert('Terjadi kesalahan saat memuat data obat.');
                });
        }
        // Handle submit form edit
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('edit_id').value;
            const formData = new FormData(this);

            // Debug: cek apakah image ada
            const imageFile = document.getElementById('edit_gambar').files[0];
            console.log('Image File:', imageFile);

            if (imageFile) {
                console.log('Image Name:', imageFile.name);
                console.log('Image Size:', imageFile.size);
                console.log('Image Type:', imageFile.type);
            }

            // Pastikan image ter-append
            if (imageFile) {
                formData.set('image', imageFile);
            }

            // Laravel butuh _method jika pakai FormData
            formData.append('_method', 'PUT');

            // Debug: lihat isi FormData
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ', pair[1]);
            }

            try {
                const response = await fetch(`/admin/obat/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json().catch(() => ({}));
                console.log('Response:', data);

                if (!response.ok) {
                    console.error('Error Response:', data);
                    alert('Gagal memperbarui data: ' + (data.message || response.statusText));
                    return;
                }

                if (data.success) {
                    alert('✅ Obat berhasil diperbarui');
                    closeModal('editModal');
                    location.reload();
                } else {
                    console.error('Update Error:', data);
                    alert('❌ ' + (data.message || 'Gagal mengupdate obat'));
                }

            } catch (error) {
                console.error('Server Error:', error);
                alert('Terjadi error saat update. Lihat console untuk detailnya.');
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
