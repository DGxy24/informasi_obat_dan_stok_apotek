<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek Sehat Sentosa - Sistem Informasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        /* Header */
        header {
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            color: white;
            padding: 1.2rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        header.scrolled {
            padding: 0.8rem 0;
            box-shadow: 0 4px 30px rgba(0,0,0,0.2);
        }
        
        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo::before {
            content: "💊";
            font-size: 2rem;
        }
        
        .login-btn {
            background: white;
            color: #0ea5e9;
            padding: 0.7rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255,255,255,0.3);
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,255,255,0.4);
        }
        
        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 2rem;
            padding-top: 140px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 4rem;
            align-items: start;
        }
        
        /* About Section */
        .about-section h1 {
            font-size: 3rem;
            color: #1e293b;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .about-section h1 .highlight {
            color: #0ea5e9;
        }
        
        .about-section p {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2rem;
            line-height: 1.8;
        }
        
        .info-card {
            background: #f8fafc;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            border-left: 4px solid #0ea5e9;
        }
        
        .info-card h3 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .info-list {
            list-style: none;
            padding: 0;
        }
        
        .info-list li {
            padding: 0.7rem 0;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .info-list li::before {
            content: "✓";
            color: #0ea5e9;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .contact-info {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 2rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            color: #1e293b;
        }
        
        .contact-item:last-child {
            margin-bottom: 0;
        }
        
        .contact-icon {
            font-size: 1.5rem;
        }
        
        /* Login Section */
        .login-section {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            position: sticky;
            top: 120px;
        }
        
        .login-section h2 {
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }
        
        .login-section p {
            color: #64748b;
            margin-bottom: 2rem;
        }
        
        .form-hidden {
            display: none;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.9rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14,165,233,0.1);
        }
        
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(14,165,233,0.4);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        
        .forgot-password a {
            color: #0ea5e9;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .toggle-form {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
        }
        
        .toggle-form a {
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }
        
        .toggle-form a:hover {
            text-decoration: underline;
        }
        
        /* Validation Styles */
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.3rem;
            display: none;
        }
        
        .error-message.show {
            display: block;
        }
        
        .form-group input.error,
        .form-group select.error {
            border-color: #dc2626;
            background-color: #fef2f2;
        }
        
        .form-group input.success,
        .form-group select.success {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }
        
        .success-message {
            color: #16a34a;
            font-size: 0.875rem;
            margin-top: 0.3rem;
            display: none;
        }
        
        .success-message.show {
            display: block;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .alert-error {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        
        /* Footer */
        footer {
            background: #1e293b;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: 80px;
        }
        
        footer p {
            color: #94a3b8;
        }
        
        /* Responsive */
        @media (max-width: 968px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            
            .about-section h1 {
                font-size: 2.5rem;
            }
            
            .login-section {
                position: static;
            }
        }
        
        @media (max-width: 640px) {
            nav {
                flex-direction: column;
                gap: 1rem;
            }
            
            .about-section h1 {
                font-size: 2rem;
            }
            
            .login-section {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">Apotek Sehat Sentosa</div>
            <a href="#login" class="login-btn">Login Sistem</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <!-- About Section -->
        <div class="about-section">
            <h1>Selamat Datang di <span class="highlight">Apotek Sehat Sentosa</span></h1>
            <p>Apotek terpercaya yang melayani kebutuhan kesehatan Anda sejak tahun 2010. Kami berkomitmen memberikan pelayanan terbaik dengan menyediakan obat-obatan berkualitas dan pelayanan farmasi profesional.</p>
            
            <div class="info-card">
                <h3>📋 Layanan Kami</h3>
                <ul class="info-list">
                    <li>Penjualan Obat Resep & Non-Resep</li>
                    <li>Konsultasi Farmasi Gratis</li>
                    <li>Pemeriksaan Tekanan Darah & Gula Darah</li>
                    <li>Pengantaran Obat (Delivery Service)</li>
                </ul>
            </div>
            
            <div class="info-card">
                <h3>⏰ Jam Operasional</h3>
                <ul class="info-list">
                    <li>Senin - Jumat: 08.00 - 21.00 WIB</li>
                    <li>Sabtu: 08.00 - 20.00 WIB</li>
                    <li>Minggu: 09.00 - 18.00 WIB</li>
                </ul>
            </div>
            
            <div class="contact-info">
                <h3 style="margin-bottom: 1rem; color: #1e293b;">📞 Hubungi Kami</h3>
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <span>Jl. Sehat Sentosa No. 123, Medan, Sumatera Utara</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <span>Telepon: (061) 1234-5678</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">📱</span>
                    <span>WhatsApp: 0812-3456-7890</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">✉️</span>
                    <span>Email: info@apoteksehatssentosa.com</span>
                </div>
            </div>
        </div>

        <!-- Login Section -->
        <div class="login-section" id="login">
            <!-- Login Form -->
            <div id="loginForm">
                <h2>Login Sistem</h2>
                <p>Masuk ke sistem informasi apotek</p>
                
                <!-- Laravel Session Messages -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST" id="formLogin">
                    @csrf
                    <div class="form-group">
                        <label for="login-username">Username</label>
                        <input type="text" id="login-username" name="username" placeholder="Masukkan username" value="{{ old('username') }}" class="@error('username') error @enderror">
                        @error('username')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" name="password" placeholder="Masukkan password" class="@error('password') error @enderror">
                        @error('password')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="submit-btn">Masuk Sistem</button>
                    
                    <div class="forgot-password">
                        <a href="#">Lupa password?</a>
                    </div>
                </form>
                
                <div class="toggle-form">
                    Belum punya akun? <a onclick="toggleForm()">Register disini</a>
                </div>
            </div>

            <!-- Register Form -->
            <div id="registerForm" class="form-hidden">
                <h2>Register Akun</h2>
                <p>Daftar akun baru sistem apotek</p>
                
                <!-- Laravel Session Messages -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif
                
                <form action="{{ route('register') }}" method="POST" id="formRegister">
                    @csrf
                    <div class="form-group">
                        <label for="reg-name">Nama Lengkap</label>
                        <input type="text" id="reg-name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" class="@error('name') error @enderror">
                        @error('name')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reg-email">Email</label>
                        <input type="email" id="reg-email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" class="@error('email') error @enderror">
                        @error('email')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reg-phone">Nomor HP</label>
                        <input type="text" id="reg-phone" name="phone" placeholder="Contoh: 081234567890" value="{{ old('phone') }}" class="@error('phone') error @enderror">
                        @error('phone')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="reg-username">Username</label>
                        <input type="text" id="reg-username" name="username" placeholder="Masukkan username" value="{{ old('username') }}" class="@error('username') error @enderror">
                        @error('username')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="reg-password">Password</label>
                        <input type="password" id="reg-password" name="password" placeholder="Masukkan password (min. 8 karakter)" class="@error('password') error @enderror">
                        @error('password')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reg-password-confirm">Konfirmasi Password</label>
                        <input type="password" id="reg-password-confirm" name="password_confirmation" placeholder="Konfirmasi password" class="@error('password_confirmation') error @enderror">
                        @error('password_confirmation')
                        <span class="error-message show">{{ $message }}</span>
                        @enderror
                        <span class="success-message" id="success-reg-password-confirm"></span>
                    </div>
                    
                    <button type="submit" class="submit-btn">Daftar Sekarang</button>
                </form>
                
                <div class="toggle-form">
                    Sudah punya akun? <a onclick="toggleForm()">Login disini</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Apotek Sehat Sentosa. Sistem Informasi Obat & Stok Apotek - Dibuat dengan Laravel</p>
    </footer>

    <script>
        // Check if there are validation errors and show the appropriate form
        @if($errors->any())
            @if(old('name') || old('email') || old('phone') || $errors->has('name') || $errors->has('email') || $errors->has('phone'))
                // Show register form if register fields have errors
                document.addEventListener('DOMContentLoaded', function() {
                    toggleForm();
                    document.querySelector('#login').scrollIntoView({ behavior: 'smooth' });
                });
            @endif
        @endif
        
        // Toggle between Login and Register
        function toggleForm() {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            if (loginForm.classList.contains('form-hidden')) {
                loginForm.classList.remove('form-hidden');
                registerForm.classList.add('form-hidden');
            } else {
                loginForm.classList.add('form-hidden');
                registerForm.classList.remove('form-hidden');
            }
        }
        
        // Real-time password confirmation validation (client-side helper)
        const regPassword = document.getElementById('reg-password');
        const regPasswordConfirm = document.getElementById('reg-password-confirm');
        const successMessage = document.getElementById('success-reg-password-confirm');
        
        if (regPasswordConfirm && regPassword) {
            regPasswordConfirm.addEventListener('input', function() {
                if (regPassword.value && regPasswordConfirm.value) {
                    if (regPassword.value === regPasswordConfirm.value) {
                        successMessage.textContent = '✓ Password cocok';
                        successMessage.classList.add('show');
                        regPasswordConfirm.classList.remove('error');
                        regPasswordConfirm.classList.add('success');
                    } else {
                        successMessage.textContent = '';
                        successMessage.classList.remove('show');
                        regPasswordConfirm.classList.remove('success');
                    }
                }
            });
            
            regPassword.addEventListener('input', function() {
                if (regPasswordConfirm.value) {
                    if (regPassword.value === regPasswordConfirm.value) {
                        successMessage.textContent = '✓ Password cocok';
                        successMessage.classList.add('show');
                        regPasswordConfirm.classList.remove('error');
                        regPasswordConfirm.classList.add('success');
                    } else {
                        successMessage.textContent = '';
                        successMessage.classList.remove('show');
                        regPasswordConfirm.classList.remove('success');
                    }
                }
            });
        }
        
        // Smooth scroll untuk tombol login
        document.querySelector('.login-btn').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('#login').scrollIntoView({ 
                behavior: 'smooth' 
            });
        });
        
        // Auto-hide success/error alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>