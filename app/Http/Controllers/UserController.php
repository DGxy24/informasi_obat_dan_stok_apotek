<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    /**
     * Handle user login
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function login(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',
            ], [
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Mohon lengkapi semua field yang diperlukan');
            }

            // Cek apakah user ada di database
            $user = User::where('username', $request->username)->first();

            if (!$user) {
                return redirect()->back()
                    ->withErrors(['username' => 'Username tidak ditemukan'])
                    ->withInput($request->only('username'))
                    ->with('error', 'Username tidak terdaftar di sistem');
            }

            // Attempt login dengan username
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];

            // Cek remember me
            $remember = $request->has('remember') ? true : false;

            if (Auth::attempt($credentials, $remember)) {
                // Regenerate session untuk keamanan
                $request->session()->regenerate();
                
                $user = Auth::user();
                
                // Log aktivitas login
                Log::info('User logged in', [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);

                // Redirect berdasarkan role
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard')
                        ->with('success', 'Login berhasil! Selamat datang Admin, ' . $user->name);
                } else {
                    return redirect()->route('obat.index')
                        ->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
                }
            }

            // Login gagal - password salah
            return redirect()->back()
                ->withErrors(['password' => 'Password yang Anda masukkan salah'])
                ->withInput($request->only('username'))
                ->with('error', 'Kredensial yang Anda masukkan tidak valid');

        } catch (Exception $e) {
            // Log error
            Log::error('Login error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat login. Silakan coba lagi.')
                ->withInput($request->only('username'));
        }
    }

    /**
     * Handle user registration
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone' => 'required|string|min:10|max:15|unique:users,phone',
                'username' => 'required|string|max:255|min:4|unique:users,username|alpha_dash',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'name.required' => 'Nama lengkap wajib diisi',
                'name.min' => 'Nama lengkap minimal 3 karakter',
                'name.max' => 'Nama lengkap maksimal 255 karakter',
                
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
                'email.max' => 'Email maksimal 255 karakter',
                
                'phone.required' => 'Nomor HP wajib diisi',
                'phone.min' => 'Nomor HP minimal 10 digit',
                'phone.max' => 'Nomor HP maksimal 15 digit',
                'phone.unique' => 'Nomor HP sudah terdaftar',
                
                'username.required' => 'Username wajib diisi',
                'username.min' => 'Username minimal 4 karakter',
                'username.max' => 'Username maksimal 255 karakter',
                'username.unique' => 'Username sudah digunakan, silakan pilih username lain',
                'username.alpha_dash' => 'Username hanya boleh mengandung huruf, angka, dash dan underscore',
                
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Mohon perbaiki error pada form registrasi');
            }

            // Log data yang akan disimpan (untuk debugging)
            Log::info('Attempting to register user', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username,
            ]);

            // Gunakan DB transaction untuk keamanan
            DB::beginTransaction();

            try {
                // Buat user baru
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                ]);

                // Commit transaction
                DB::commit();

                // Log aktivitas registrasi
                Log::info('New user registered', [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'ip_address' => $request->ip()
                ]);

                // Auto login setelah register
                Auth::login($user);

                // Regenerate session
                $request->session()->regenerate();

                return redirect()->route('obat.index')
                    ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '. Akun Anda telah aktif.');

            } catch (Exception $e) {
                // Rollback jika ada error
                DB::rollBack();
                
                Log::error('Registration database error: ' . $e->getMessage());
                
                // Untuk development, tampilkan error detail (hapus di production)
                if (config('app.debug')) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Error: ' . $e->getMessage());
                }
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            }

        } catch (Exception $e) {
            // Log error
            Log::error('Registration error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }

    /**
     * Handle user logout
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        try {
            // Log aktivitas logout
            Log::info('User logged out', [
                'user_id' => Auth::id(),
                'username' => Auth::user()->username,
                'ip_address' => $request->ip()
            ]);

            // Logout user
            Auth::logout();

            // Invalidate session
            $request->session()->invalidate();

            // Regenerate CSRF token
            $request->session()->regenerateToken();

            return redirect()->route('home')
                ->with('success', 'Anda telah berhasil logout. Sampai jumpa kembali!');

        } catch (Exception $e) {
            // Log error
            Log::error('Logout error: ' . $e->getMessage());
            
            return redirect()->route('home')
                ->with('error', 'Terjadi kesalahan saat logout');
        }
    }

    /**
     * Show user profile (optional)
     * 
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        try {
            $user = Auth::user();
            return view('profile', compact('user'));
        } catch (Exception $e) {
            Log::error('Profile view error: ' . $e->getMessage());
            return redirect()->route('dashboard')
                ->with('error', 'Tidak dapat menampilkan profil');
        }
    }

    /**
     * Update user profile (optional)
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'required|string|min:10|max:15|regex:/^[0-9]+$/|unique:users,phone,' . $user->id,
                'username' => 'required|string|max:255|min:4|unique:users,username,' . $user->id . '|alpha_dash',
            ], [
                'name.required' => 'Nama lengkap wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'phone.required' => 'Nomor HP wajib diisi',
                'phone.min' => 'Nomor HP minimal 10 digit',
                'phone.max' => 'Nomor HP maksimal 15 digit',
                'phone.regex' => 'Nomor HP hanya boleh berisi angka',
                'phone.unique' => 'Nomor HP sudah digunakan',
                'username.required' => 'Username wajib diisi',
                'username.unique' => 'Username sudah digunakan',
                'username.alpha_dash' => 'Username hanya boleh mengandung huruf, angka, dash dan underscore',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'username' => $request->username,
                ]);

                DB::commit();

                Log::info('User profile updated', [
                    'user_id' => $user->id,
                    'username' => $user->username
                ]);

                return redirect()->back()
                    ->with('success', 'Profil berhasil diperbarui');

            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Profile update database error: ' . $e->getMessage());
                
                return redirect()->back()
                    ->with('error', 'Gagal memperbarui profil');
            }

        } catch (Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil');
        }
    }

    /**
     * Change password (optional)
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed|different:current_password',
            ], [
                'current_password.required' => 'Password lama wajib diisi',
                'new_password.required' => 'Password baru wajib diisi',
                'new_password.min' => 'Password baru minimal 8 karakter',
                'new_password.confirmed' => 'Konfirmasi password tidak cocok',
                'new_password.different' => 'Password baru harus berbeda dengan password lama',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator);
            }

            $user = Auth::user();

            // Cek apakah password lama benar
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Password lama tidak sesuai'])
                    ->with('error', 'Password lama yang Anda masukkan salah');
            }

            DB::beginTransaction();

            try {
                // Update password
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);

                DB::commit();

                Log::info('User password changed', [
                    'user_id' => $user->id,
                    'username' => $user->username
                ]);

                return redirect()->back()
                    ->with('success', 'Password berhasil diubah');

            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Password change database error: ' . $e->getMessage());
                
                return redirect()->back()
                    ->with('error', 'Gagal mengubah password');
            }

        } catch (Exception $e) {
            Log::error('Password change error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengubah password');
        }
    }
}