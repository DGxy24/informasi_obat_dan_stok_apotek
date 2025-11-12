@extends('admin.template')

@section('title', 'Tambah User')

@section('page-title', 'Tambah User Baru')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 2rem;
        max-width: 800px;
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
    }
    
    .form-header p {
        color: #64748b;
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
    
    .form-control.error {
        border-color: #ef4444;
        background-color: #fef2f2;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.3rem;
        display: block;
    }
    
    .form-help {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 0.3rem;
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
    }
    
    .radio-group {
        display: flex;
        gap: 1.5rem;
        margin-top: 0.5rem;
    }
    
    .radio-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .radio-item input[type="radio"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    
    .radio-item label {
        cursor: pointer;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <div class="form-header">
        <h2>➕ Tambah User Baru</h2>
        <p>Lengkapi form di bawah untuk menambahkan user baru</p>
    </div>
    
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">
                Nama Lengkap <span class="required">*</span>
            </label>
            <input type="text" name="name" class="form-control @error('name') error @enderror" 
                   value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label">
                Email <span class="required">*</span>
            </label>
            <input type="email" name="email" class="form-control @error('email') error @enderror" 
                   value="{{ old('email') }}" placeholder="contoh@email.com">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label">
                Nomor HP <span class="required">*</span>
            </label>
            <input type="text" name="phone" class="form-control @error('phone') error @enderror" 
                   value="{{ old('phone') }}" placeholder="081234567890">
            @error('phone')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <span class="form-help">Format: 08xxxxxxxxxx (hanya angka)</span>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                Username <span class="required">*</span>
            </label>
            <input type="text" name="username" class="form-control @error('username') error @enderror" 
                   value="{{ old('username') }}" placeholder="username">
            @error('username')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <span class="form-help">Minimal 4 karakter, hanya huruf, angka, dash dan underscore</span>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                Password <span class="required">*</span>
            </label>
            <input type="password" name="password" class="form-control @error('password') error @enderror" 
                   placeholder="Minimal 8 karakter">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label">
                Role <span class="required">*</span>
            </label>
            <div class="radio-group">
                <div class="radio-item">
                    <input type="radio" name="role" id="role-user" value="user" 
                           {{ old('role') == 'user' || !old('role') ? 'checked' : '' }}>
                    <label for="role-user">👤 User</label>
                </div>
                <div class="radio-item">
                    <input type="radio" name="role" id="role-admin" value="admin"
                           {{ old('role') == 'admin' ? 'checked' : '' }}>
                    <label for="role-admin">👑 Admin</label>
                </div>
            </div>
            @error('role')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                ← Batal
            </a>
            <button type="submit" class="btn btn-primary">
                ✓ Simpan User
            </button>
        </div>
    </form>
</div>
@endsection