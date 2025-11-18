@extends('admin.template')

@section('title', 'Kelola Stok')

@section('page-title', 'Kelola Stok Obat')

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

        .medicine-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .medicine-icon {
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

        .medicine-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .medicine-name {
            font-weight: 600;
            color: #1e293b;
        }

        .medicine-category {
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

        .badge-info {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
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

        .btn-add-stock {
            background: #d1fae5;
            color: #065f46;
        }

        .btn-add-stock:hover {
            background: #a7f3d0;
            transform: translateY(-2px);
        }

        .btn-reduce-stock {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-reduce-stock:hover {
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

        .current-stock {
            background: #f0f9ff;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .current-stock-label {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .current-stock-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stock-quantity {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
        }

        .info-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #92400e;
        }
    </style>
@endsection

@section('content')
    <div class="page-actions">
        <form action="{{ route('admin.stock.index') }}" method="GET" class="search-filter">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari nama obat..." value="{{ request('search') }}">
            </div>

            <button type="submit" class="btn-primary btn-search">
                🔍 Cari
            </button>
        </form>
        <button onclick="openCreateStockModal()" class="btn-primary">
            ➕ Tambah Stok Baru
        </button>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Obat</th>
                    <th>Jumlah Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $index => $stock)
                    <tr>
                        <td>{{ $stocks->firstItem() + $index }}</td>
                        <td>
                            <div class="medicine-info">
                                <div class="medicine-icon">
                                    @if ($stock->medicine->image)
                                        <img src="{{ asset('storage/' . $stock->medicine->image) }}"
                                            alt="{{ $stock->medicine->name }}">
                                    @else
                                        💊
                                    @endif
                                </div>
                                <div>
                                    <div class="medicine-name">{{ $stock->medicine->name }}</div>
                                    <div class="medicine-category">{{ $stock->medicine->category->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="stock-quantity">{{ $stock->quantity }}</span>
                        </td>
                        <td>
                            @if ($stock->quantity >= 50)
                                <span class="badge badge-success">✓ Tersedia</span>
                            @elseif($stock->quantity > 0)
                                <span class="badge badge-warning">⚠️ Stok Rendah</span>
                            @else
                                <span class="badge badge-danger">✗ Habis</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="openAddStockModal({{ $stock->medicine_id }})"
                                    class="btn-sm btn-add-stock">
                                    ➕ Tambah
                                </button>
                                <button onclick="openReduceStockModal({{ $stock->medicine_id }})"
                                    class="btn-sm btn-reduce-stock">
                                    ➖ Kurangi
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">📦</div>
                            <h3>Belum ada data stok</h3>
                            <p style="color: #64748b;">Tambahkan stok untuk obat yang baru ditambahkan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($stocks->hasPages())
            <div style="display: flex; justify-content: center; padding: 1.5rem; gap: 0.5rem;">
                @if ($stocks->onFirstPage())
                    <span style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">« Prev</span>
                @else
                    <a href="{{ $stocks->previousPageUrl() }}"
                        style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">«
                        Prev</a>
                @endif

                @foreach ($stocks->getUrlRange(1, $stocks->lastPage()) as $page => $url)
                    @if ($page == $stocks->currentPage())
                        <span
                            style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border-radius: 8px;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($stocks->hasMorePages())
                    <a href="{{ $stocks->nextPageUrl() }}"
                        style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #475569;">Next
                        »</a>
                @else
                    <span style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px;">Next »</span>
                @endif
            </div>
        @endif
    </div>

    <!-- Modal Create Stock (untuk obat baru) -->
    <div id="createStockModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">📦 Tambah Stok Obat Baru</h3>
                <button class="modal-close" onclick="closeModal('createStockModal')">✕</button>
            </div>
            <form id="createStockForm">
                @csrf
                <div class="modal-body">
                    <div class="info-box">
                        ℹ️ Gunakan form ini untuk menambahkan stok AWAL pada obat baru yang belum memiliki stok.
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pilih Obat *</label>
                        <select name="medicine_id" id="create_medicine_id" class="form-control" required>
                            <option value="">-- Pilih Obat --</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jumlah Stok Awal *</label>
                        <input type="number" name="quantity" class="form-control" required min="0"
                            placeholder="Masukkan jumlah stok awal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('createStockModal')">Batal</button>
                    <button type="submit" class="btn-primary">💾 Simpan Stok</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Stok (untuk update stok yang sudah ada) -->
    <div id="addStockModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">➕ Tambah Stok</h3>
                <button class="modal-close" onclick="closeModal('addStockModal')">✕</button>
            </div>
            <form id="addStockForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="add_medicine_id" name="medicine_id">

                    <div class="current-stock">
                        <div class="current-stock-label">Stok Saat Ini</div>
                        <div class="current-stock-value" id="add_current_stock">0</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Obat</label>
                        <input type="text" id="add_medicine_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jumlah yang Ditambahkan *</label>
                        <input type="number" name="quantity" class="form-control" required min="1"
                            placeholder="Masukkan jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('addStockModal')">Batal</button>
                    <button type="submit" class="btn-primary">💾 Tambah Stok</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Kurangi Stok -->
    <div id="reduceStockModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">➖ Kurangi Stok</h3>
                <button class="modal-close" onclick="closeModal('reduceStockModal')">✕</button>
            </div>
            <form id="reduceStockForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="reduce_medicine_id" name="medicine_id">

                    <div class="current-stock">
                        <div class="current-stock-label">Stok Saat Ini</div>
                        <div class="current-stock-value" id="reduce_current_stock">0</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Obat</label>
                        <input type="text" id="reduce_medicine_name" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jumlah yang Dikurangi *</label>
                        <input type="number" id="reduce_quantity" name="quantity" class="form-control" required
                            min="1" placeholder="Masukkan jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('reduceStockModal')">Batal</button>
                    <button type="submit" class="btn-primary">💾 Kurangi Stok</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openCreateStockModal() {
            document.getElementById('createStockModal').classList.add('show');
        }

        function openAddStockModal(medicineId) {
            fetch(`/admin/stock/${medicineId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const stock = data.data;
                        document.getElementById('add_medicine_id').value = stock.medicine_id;
                        document.getElementById('add_medicine_name').value = stock.medicine.name;
                        document.getElementById('add_current_stock').textContent = stock.quantity;
                        document.getElementById('addStockModal').classList.add('show');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data stok');
                });
        }

        function openReduceStockModal(medicineId) {
            fetch(`/admin/stock/${medicineId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const stock = data.data;

                        document.getElementById('reduce_medicine_id').value = stock.medicine_id;
                        document.getElementById('reduce_medicine_name').value = stock.medicine.name;
                        document.getElementById('reduce_current_stock').textContent = stock.quantity;

                        // Set max quantity to current stock
                        document.getElementById('reduce_quantity').max = stock.quantity;

                        document.getElementById('reduceStockModal').classList.add('show');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data stok');
                });
        }

        // Handle submit form create stock (obat baru)
        document.getElementById('createStockForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('/admin/stock/create', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Stok berhasil ditambahkan');
                    closeModal('createStockModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal menambahkan stok'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat menambahkan stok');
            }
        });

        // Handle submit form tambah stok (update stok yang ada)
        document.getElementById('addStockForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('/admin/stock/add', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Stok berhasil ditambahkan');
                    closeModal('addStockModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal menambahkan stok'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat menambahkan stok');
            }
        });

        // Handle submit form kurangi stok
        document.getElementById('reduceStockForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const quantity = parseInt(document.getElementById('reduce_quantity').value);
            const currentStock = parseInt(document.getElementById('reduce_current_stock').textContent);

            if (quantity > currentStock) {
                alert('❌ Jumlah yang dikurangi melebihi stok tersedia!');
                return;
            }

            try {
                const response = await fetch('/admin/stock/reduce', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    alert('✅ Stok berhasil dikurangi');
                    closeModal('reduceStockModal');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal mengurangi stok'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi error saat mengurangi stok');
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