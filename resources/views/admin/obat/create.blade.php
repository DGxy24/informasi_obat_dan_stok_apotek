@extends('admin.template')

@section('title', 'Tambah Obat')

@section('page-title', 'Tambah Obat Baru')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 2rem;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .form-header h2 {
        color: #1e293b;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-header p {
        color: #64748b;
        margin: 0;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        display: block;
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .form-label .required {
        color: #ef4444;
        margin-left: 2px;
    }
    
    .form-control {
        width: 100%;
        padding: 0.9rem 1.2rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s;
        font-family: inherit;
        background: white;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-control.error {
        border-color: #ef4444;
        background-color: #fef2f2;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .error-message::before {
        content: "⚠️";
    }
    
    .form-help {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    .image-upload-area {
        border: 2px dashed #e2e8f0;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8fafc;
    }
    
    .image-upload-area:hover {
        border-color: #3b82f6;
        background: #f0f9ff;
    }
    
    .image-upload-area.dragover {
        border-color: #3b82f6;
        background: #dbeafe;
        transform: scale(1.02);
    }
    
    .upload-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .upload-text {
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .upload-hint {
        color: #94a3b8;
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }
    
    #imageInput {
        display: none;
    }
    
    .image-preview {
        margin-top: 1rem;
        display: none;
        text-align: center;
    }
    
    .image-preview.show {
        display: block;
    }
    
    .preview-image {
        max-width: 100%;
        max-height: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }
    
    .remove-image {
        background: #ef4444;
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .remove-image:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #e2e8f0;
    }
    
    .btn {
        padding: 0.9rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        font-size: 0.95rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }
    
    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
    }
    
    .btn-secondary:hover {
        background: #e2e8f0;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-card {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <div class="form-header">
        <h2>💊 Tambah Obat Baru</h2>
        <p>Lengkapi form di bawah untuk menambahkan obat baru ke sistem</p>
    </div>
    
    <form action="{{ route('admin.obat.store') }}" method="POST" enctype="multipart/form-data" id="medicineForm">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">
                    Nama Obat <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-control @error('name') error @enderror" 
                       value="{{ old('name') }}" placeholder="Contoh: Paracetamol 500mg" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Nama Generik
                </label>
                <input type="text" name="generic_name" class="form-control @error('generic_name') error @enderror" 
                       value="{{ old('generic_name') }}" placeholder="Nama generik obat">
                @error('generic_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <span class="form-help">Opsional - Nama generik dari obat</span>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">
                    Kategori <span class="required">*</span>
                </label>
                <select name="category_id" class="form-control @error('category_id') error @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Supplier
                </label>
                <select name="supplier_id" class="form-control @error('supplier_id') error @enderror">
                    <option value="">-- Pilih Supplier (Opsional) --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}{{ $supplier->contact_person ? ' - ' . $supplier->contact_person : '' }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <span class="form-help">Opsional - Kosongkan jika belum ditentukan</span>
            </div>
        </div>
        
        <div class="form-group full-width">
            <label class="form-label">
                Deskripsi
            </label>
            <textarea name="description" class="form-control @error('description') error @enderror" 
                      placeholder="Masukkan deskripsi obat, kegunaan, efek samping, cara pakai, dll.">{{ old('description') }}</textarea>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <span class="form-help">Opsional - Informasi lengkap tentang obat</span>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">
                    Harga <span class="required">*</span>
                </label>
                <input type="number" name="price" class="form-control @error('price') error @enderror" 
                       value="{{ old('price') }}" placeholder="0" min="0" step="0.01" required>
                @error('price')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <span class="form-help">Harga satuan dalam Rupiah</span>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    Satuan <span class="required">*</span>
                </label>
                <select name="unit" class="form-control @error('unit') error @enderror" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="tablet" {{ old('unit') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="kapsul" {{ old('unit') == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                    <option value="botol" {{ old('unit') == 'botol' ? 'selected' : '' }}>Botol</option>
                    <option value="tube" {{ old('unit') == 'tube' ? 'selected' : '' }}>Tube</option>
                    <option value="strip" {{ old('unit') == 'strip' ? 'selected' : '' }}>Strip</option>
                    <option value="box" {{ old('unit') == 'box' ? 'selected' : '' }}>Box</option>
                    <option value="ampul" {{ old('unit') == 'ampul' ? 'selected' : '' }}>Ampul</option>
                    <option value="vial" {{ old('unit') == 'vial' ? 'selected' : '' }}>Vial</option>
                    <option value="sachet" {{ old('unit') == 'sachet' ? 'selected' : '' }}>Sachet</option>
                    <option value="ml" {{ old('unit') == 'ml' ? 'selected' : '' }}>ml (mililiter)</option>
                </select>
                @error('unit')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                Gambar Obat
            </label>
            <div class="image-upload-area" id="uploadArea" onclick="document.getElementById('imageInput').click()">
                <div class="upload-icon">📷</div>
                <div class="upload-text">Klik untuk upload gambar</div>
                <div class="upload-hint">atau drag & drop gambar disini</div>
                <div class="upload-hint">Format: JPG, PNG, JPEG (Max: 2MB)</div>
            </div>
            <input type="file" id="imageInput" name="image" accept="image/jpeg,image/png,image/jpg">
            @error('image')
                <span class="error-message">{{ $message }}</span>
            @enderror
            
            <div class="image-preview" id="imagePreview">
                <img id="previewImg" src="" alt="Preview" class="preview-image">
                <button type="button" class="remove-image" onclick="removeImage()">
                    🗑️ Hapus Gambar
                </button>
            </div>
            <span class="form-help">Opsional - Upload foto obat untuk memudahkan identifikasi</span>
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">
                ← Batal
            </a>
            <button type="submit" class="btn btn-primary">
                ✓ Simpan Obat
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });
    
    // Highlight drop area when dragging over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, function() {
            uploadArea.classList.add('dragover');
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, function() {
            uploadArea.classList.remove('dragover');
        }, false);
    });
    
    // Handle drop
    uploadArea.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            imageInput.files = files;
            handleFiles(files);
        }
    }, false);
    
    function handleFiles(files) {
        if (files.length === 0) return;
        
        const file = files[0];
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!validTypes.includes(file.type)) {
            alert('❌ File harus berupa gambar (JPG, JPEG, atau PNG)!');
            imageInput.value = '';
            return;
        }
        
        // Validate file size (max 2MB)
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        if (file.size > maxSize) {
            alert('❌ Ukuran file maksimal 2MB!');
            imageInput.value = '';
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            imagePreview.classList.add('show');
            uploadArea.style.display = 'none';
        };
        reader.onerror = function() {
            alert('❌ Gagal membaca file!');
            imageInput.value = '';
        };
        reader.readAsDataURL(file);
    }
    
    function removeImage() {
        imageInput.value = '';
        previewImg.src = '';
        imagePreview.classList.remove('show');
        uploadArea.style.display = 'block';
    }
    
    // Form validation before submit
    document.getElementById('medicineForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('⚠️ Mohon lengkapi semua field yang wajib diisi!');
        }
    });
</script>
@endsection