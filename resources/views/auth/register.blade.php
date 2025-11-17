<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - {{ config('app.name', 'TaskFlow') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            overflow-x: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .register-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-wrapper {
            width: 100%;
            max-width: 480px;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            display: inline-block;
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            margin-bottom: 0.5rem;
        }

        .brand-tagline {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .register-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .register-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .register-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-subtitle a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-subtitle a:hover {
            color: #2563eb;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.875rem;
            transition: all 0.3s;
            background: #f9fafb;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .form-hint {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.5rem;
            line-height: 1.4;
        }

        .form-hint a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .form-hint a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.5rem;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            gap: 1rem;
        }

        .login-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: #3b82f6;
        }

        .btn-register {
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .divider span {
            padding: 0 1rem;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #3b82f6;
        }

        @media (max-width: 640px) {
            .register-card {
                padding: 2rem 1.5rem;
            }

            .register-title {
                font-size: 1.5rem;
            }

            .brand-logo {
                font-size: 2rem;
            }

            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn-register {
                width: 100%;
            }

            .login-link {
                text-align: center;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div id="particles-js"></div>
    
    <div class="register-container">
        <div class="register-wrapper">
            <div class="brand-header">
                <a href="/" class="brand-logo">TaskFlow</a>
                <p class="brand-tagline">Mulai kelola tugas dengan lebih baik</p>
            </div>

            <div class="register-card">
                <h2 class="register-title">Buat Akun Baru</h2>
                <p class="register-subtitle">
                    Bergabunglah dan tingkatkan produktivitasmu
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Masukkan nama lengkap"
                            class="form-input"
                        >
                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="username"
                            placeholder="nama@email.com"
                            class="form-input"
                        >
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telegram_chat_id" class="form-label">Telegram Chat ID (Opsional)</label>
                        <input 
                            id="telegram_chat_id" 
                            type="text" 
                            name="telegram_chat_id" 
                            value="{{ old('telegram_chat_id') }}" 
                            autocomplete="telegram_chat_id"
                            placeholder="Masukkan Telegram Chat ID"
                            class="form-input"
                        >
                        <p class="form-hint">
                            Dapatkan ID Anda dari bot <a href="https://t.me/userinfobot" target="_blank">@userinfobot</a> di Telegram untuk notifikasi.
                        </p>
                        @error('telegram_chat_id')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="form-input"
                        >
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="form-input"
                        >
                        @error('password_confirmation')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-footer">
                        <a class="login-link" href="{{ route('login') }}">
                            Sudah punya akun?
                        </a>
                        <button type="submit" class="btn-register">
                            Daftar
                        </button>
                    </div>
                </form>

                <div class="divider">
                    <span>atau</span>
                </div>

                <a href="/" class="back-link">← Kembali ke halaman utama</a>
            </div>
        </div>
    </div>

    <script>
        // Initialize Particles.js with same config as welcome screen
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: ['#3b82f6', '#8b5cf6', '#10b981'] },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#3b82f6',
                    opacity: 0.3,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'right',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: false },
                    resize: true
                },
                modes: {
                    repulse: { distance: 100, duration: 0.4 }
                }
            },
            retina_detect: true
        });
    </script>
</body>
</html>