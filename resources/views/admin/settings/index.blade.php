@extends('admin.template')

@section('title', 'Pengaturan Apotek')

@section('page-title', 'Pengaturan Apotek')

@section('styles')
<style>
    .settings-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .settings-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
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
    }

    .form-control {
        width: 100%;
        padding: 0.9rem 1.2rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .logo-upload-section {
        display: flex;
        gap: 2rem;
        align-items: start;
    }

    .logo-preview {
        width: 150px;
        height: 150px;
        border-radius: 15px;
        border: 2px dashed #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8fafc;
    }

    .logo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .logo-placeholder {
        font-size: 3rem;
    }

    .logo-upload-input {
        flex: 1;
    }

    .upload-hint {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .time-input {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .time-separator {
        font-weight: 700;
        color: #64748b;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef4444;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
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
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .logo-upload-section {
            flex-direction: column;
        }

        .logo-preview {
            width: 100%;
            height: 200px;
        }
    }
</style>
@endsection

@section('content')
<div class="settings-container">
    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ✗ {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Informasi Umum -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon">🏥</div>
                <h3 class="card-title">Informasi Umum</h3>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">
                        Nama Apotek <span class="required">*</span>
                    </label>
                    <input type="text" name="nama_apotek" class="form-control @error('nama_apotek') error @enderror" 
                           value="{{ old('nama_apotek', $apotek->nama_apotek) }}" required>
                    @error('nama_apotek')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Telepon
                    </label>
                    <input type="text" name="telepon" class="form-control @error('telepon') error @enderror" 
                           value="{{ old('telepon', $apotek->telepon) }}">
                    @error('telepon')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label class="form-label">
                        Email
                    </label>
                    <input type="email" name="email" class="form-control @error('email') error @enderror" 
                           value="{{ old('email', $apotek->email) }}">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group full-width">
                <label class="form-label">
                    Alamat <span class="required">*</span>
                </label>
                <textarea name="alamat" class="form-control @error('alamat') error @enderror" required>{{ old('alamat', $apotek->alamat) }}</textarea>
                @error('alamat')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label class="form-label">Jam Operasional</label>
                <textarea name="jam_operasional" class="form-control @error('jam_operasional') error @enderror" 
                          placeholder="Contoh:&#10;Senin - Jumat: 08.00 - 21.00 WIB&#10;Sabtu: 08.00 - 20.00 WIB&#10;Minggu & Hari Libur: 09.00 - 18.00 WIB" 
                          style="min-height: 100px;">{{ old('jam_operasional', $apotek->jam_operasional) }}</textarea>
                @error('jam_operasional')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <div class="upload-hint">💡 Tips: Pisahkan setiap hari dengan enter/baris baru</div>
            </div>
        </div>

        <!-- Logo -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon">🖼️</div>
                <h3 class="card-title">Logo Apotek</h3>
            </div>

            <div class="logo-upload-section">
                <div class="logo-preview">
                    @if($apotek->logo)
                        <img src="{{ asset('storage/' . $apotek->logo) }}" alt="Logo" id="logoPreview">
                    @else
                        <div class="logo-placeholder" id="logoPlaceholder">🏥</div>
                    @endif
                </div>

                <div class="logo-upload-input">
                    <div class="form-group">
                        <label class="form-label">Upload Logo Baru</label>
                        <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewLogo(event)">
                        <div class="upload-hint">Format: JPG, PNG, JPEG (Max: 2MB)</div>
                        @error('logo')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Tentang Apotek -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon">📖</div>
                <h3 class="card-title">Tentang Apotek</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Sejarah Singkat</label>
                <textarea name="sejarah" class="form-control @error('sejarah') error @enderror">{{ old('sejarah', $apotek->sejarah) }}</textarea>
                @error('sejarah')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Visi</label>
                <textarea name="visi" class="form-control @error('visi') error @enderror">{{ old('visi', $apotek->visi) }}</textarea>
                @error('visi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Misi</label>
                <textarea name="misi" class="form-control @error('misi') error @enderror" placeholder="Pisahkan setiap poin dengan enter">{{ old('misi', $apotek->misi) }}</textarea>
                @error('misi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Layanan -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon">💊</div>
                <h3 class="card-title">Layanan</h3>
            </div>

            <div class="form-group">
                <label class="form-label">Daftar Layanan</label>
                <textarea name="layanan" class="form-control @error('layanan') error @enderror" placeholder="Pisahkan setiap layanan dengan enter atau gunakan tanda - untuk bullet">{{ old('layanan', $apotek->layanan) }}</textarea>
                @error('layanan')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                ← Batal
            </a>
            <button type="submit" class="btn btn-primary">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewLogo(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('logoPreview');
                const placeholder = document.getElementById('logoPlaceholder');
                
                if (preview) {
                    preview.src = e.target.result;
                } else if (placeholder) {
                    placeholder.parentElement.innerHTML = `<img src="${e.target.result}" alt="Logo Preview" id="logoPreview">`;
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection