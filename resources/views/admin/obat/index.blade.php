@extends('admin.template')

@section('title', 'Kelola Obat')

@section('page-title', 'Kelola Obat')

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
                                        <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}">
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
                        <td>{{ optional($medicine->stocks)->quantity ?? '-' }}</td>
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
                                <button onclick="viewMedicine({{ $medicine->id }})" class="btn-sm btn-view">
                                    👁️ Lihat
                                </button>
                                <button onclick="editMedicine({{ $medicine->id }})" class="btn-sm btn-edit">
                                    ✏️ Edit
                                </button>
                                <form action="{{ route('admin.obat.destroy', $medicine->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $medicine->name }}?')">
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
                        <td colspan="8" style="text-align: center; padding: 3rem;">
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
                        <label class="form-label">Nama Obat *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Generik</label>
                        <input type="text" id="edit_generic_name" name="generic_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori *</label>
                        <select id="edit_category_id" name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Supplier</label>
                        <select id="edit_supplier_id" name="supplier_id" class="form-control">
                            <option value="">-- Pilih Supplier (Opsional) --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}{{ $supplier->contact_person ? ' - ' . $supplier->contact_person : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea id="edit_description" name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga *</label>
                        <input type="number" id="edit_price" name="price" class="form-control" required min="0" step="0.01">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Satuan *</label>
                        <select id="edit_unit" name="unit" class="form-control" required>
                            <option value="">-- Pilih Satuan --</option>
                            <option value="tablet">Tablet</option>
                            <option value="kapsul">Kapsul</option>
                            <option value="botol">Botol</option>
                            <option value="tube">Tube</option>
                            <option value="strip">Strip</option>
                            <option value="box">Box</option>
                            <option value="ampul">Ampul</option>
                            <option value="vial">Vial</option>
                            <option value="sachet">Sachet</option>
                            <option value="ml">ml (mililiter)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Gambar Saat Ini</label>
                        <div id="current_image_preview" style="margin-bottom: 1rem;"></div>
                        <label class="form-label">Upload Gambar Baru (Opsional)</label>
                        <input type="file" id="edit_image" name="image" class="form-control" accept="image/*">
                        <small style="color: #64748b;">Kosongkan jika tidak ingin mengubah gambar</small>
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
                        const imageHtml = medicine.image ?
                            `<img src="/storage/${medicine.image}" alt="${medicine.name}" class="detail-image">` :
                            '<div style="font-size: 4rem;">💊</div>';

                        modalBody.innerHTML = `
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        ${imageHtml}
                    </div>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #475569; font-size: 0.9rem;">📋 INFORMASI UMUM</h4>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Nama Obat</div>
                        <div class="detail-value">${medicine.name}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Nama Generik</div>
                        <div class="detail-value">${medicine.generic_name || '-'}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Kategori</div>
                        <div class="detail-value">${medicine.category.name}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Deskripsi</div>
                        <div class="detail-value">${medicine.description || '-'}</div>
                    </div>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; margin-top: 1.5rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #475569; font-size: 0.9rem;">💰 HARGA & SATUAN</h4>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Harga</div>
                        <div class="detail-value" style="font-size: 1.3rem; color: #10b981; font-weight: 700;">
                            Rp ${Number(medicine.price).toLocaleString('id-ID')}
                        </div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Satuan</div>
                        <div class="detail-value">${medicine.unit}</div>
                    </div>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; margin-top: 1.5rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #475569; font-size: 0.9rem;">📦 STOK & SUPPLIER</h4>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Stok Tersedia</div>
                        <div class="detail-value" style="font-size: 1.3rem; color: #3b82f6; font-weight: 700;">
                            ${medicine.stocks ? medicine.stocks.quantity : 0} ${medicine.unit}
                        </div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Supplier</div>
                        <div class="detail-value">
                            ${medicine.supplier ? `
                                <div style="background: #eff6ff; padding: 0.8rem; border-radius: 8px; border-left: 3px solid #3b82f6;">
                                    <div style="font-weight: 600; color: #1e293b; margin-bottom: 0.3rem;">
                                        🏢 ${medicine.supplier.name}
                                    </div>
                                    ${medicine.supplier.contact_person ? `
                                        <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 0.2rem;">
                                            👤 ${medicine.supplier.contact_person}
                                        </div>
                                    ` : ''}
                                    ${medicine.supplier.phone ? `
                                        <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 0.2rem;">
                                            📞 ${medicine.supplier.phone}
                                        </div>
                                    ` : ''}
                                    ${medicine.supplier.address ? `
                                        <div style="font-size: 0.85rem; color: #64748b;">
                                            📍 ${medicine.supplier.address}
                                        </div>
                                    ` : ''}
                                </div>
                            ` : '<span style="color: #94a3b8;">Belum ada supplier</span>'}
                        </div>
                    </div>
                    
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; margin-top: 1.5rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #475569; font-size: 0.9rem;">📅 INFORMASI TAMBAHAN</h4>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Ditambahkan Pada</div>
                        <div class="detail-value">${new Date(medicine.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        })}</div>
                    </div>
                    
                    <div class="detail-group">
                        <div class="detail-label">Terakhir Diupdate</div>
                        <div class="detail-value">${new Date(medicine.updated_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        })}</div>
                    </div>
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
                        
                        console.log('Medicine data:', medicine); // Debug log
                        
                        // Set semua field
                        document.getElementById('edit_id').value = medicine.id;
                        document.getElementById('edit_name').value = medicine.name;
                        document.getElementById('edit_generic_name').value = medicine.generic_name || '';
                        document.getElementById('edit_category_id').value = medicine.category_id;
                        document.getElementById('edit_supplier_id').value = medicine.supplier_id || '';
                        document.getElementById('edit_description').value = medicine.description || '';
                        document.getElementById('edit_price').value = medicine.price;
                        
                        // Set unit/satuan - pastikan value match dengan option value
                        const unitSelect = document.getElementById('edit_unit');
                        console.log('Unit from DB:', medicine.unit); // Debug log
                        
                        // Cari option yang match (case insensitive)
                        const unitValue = medicine.unit ? medicine.unit.toLowerCase() : '';
                        let optionFound = false;
                        
                        for (let i = 0; i < unitSelect.options.length; i++) {
                            if (unitSelect.options[i].value.toLowerCase() === unitValue) {
                                unitSelect.value = unitSelect.options[i].value;
                                optionFound = true;
                                console.log('Unit matched:', unitSelect.options[i].value); // Debug log
                                break;
                            }
                        }
                        
                        if (!optionFound && unitValue) {
                            console.warn('Unit not found in options:', medicine.unit);
                            // Set value anyway, mungkin ada custom value
                            unitSelect.value = medicine.unit;
                        }

                        // Show current image
                        const imagePreview = document.getElementById('current_image_preview');
                        if (medicine.image) {
                            imagePreview.innerHTML = `
                                <img src="/storage/${medicine.image}" 
                                     alt="Current image" 
                                     style="max-width: 200px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            `;
                        } else {
                            imagePreview.innerHTML = '<span style="color: #64748b;">Tidak ada gambar</span>';
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

        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('edit_id').value;
            const formData = new FormData(this);
            const imageFile = document.getElementById('edit_image').files[0];

            // Only append image if a new one is selected
            if (imageFile) {
                formData.set('image', imageFile);
            }

            // Add _method for Laravel
            formData.append('_method', 'PUT');

            // Debug: log form data
            console.log('Submitting data:');
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
                    
                    // Show validation errors if any
                    if (data.errors) {
                        let errorMsg = 'Validation errors:\n';
                        for (let field in data.errors) {
                            errorMsg += `- ${field}: ${data.errors[field].join(', ')}\n`;
                        }
                        alert(errorMsg);
                    } else {
                        alert('Gagal memperbarui data: ' + (data.message || response.statusText));
                    }
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
                alert('Terjadi error saat update: ' + error.message);
            }
        });

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });
    </script>
@endsection