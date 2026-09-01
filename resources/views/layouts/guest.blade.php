<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Shopp Reparos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                            'display': ['Poppins', 'system-ui', '-apple-system', 'sans-serif'],
                        },
                        colors: {
                            'primary': {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                200: '#bfdbfe',
                                300: '#93c5fd',
                                400: '#60a5fa',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            },
                            'accent': {
                                50: '#f0fdf4',
                                100: '#dcfce7',
                                200: '#bbf7d0',
                                300: '#86efac',
                                400: '#4ade80',
                                500: '#22c55e',
                                600: '#16a34a',
                                700: '#15803d',
                                800: '#166534',
                                900: '#14532d',
                            }
                        }
                    }
                }
            }
        </script>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            }
            
            .auth-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .form-input {
                border: 2px solid #e5e7eb;
                transition: all 0.3s ease;
            }
            
            .form-input:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
            }
            
            .logo-container {
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
                border-radius: 20px;
                padding: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            @media (max-width: 640px) {
                .auth-card {
                    margin: 20px;
                    padding: 30px 25px;
                }
                
                .logo-container {
                    padding: 15px;
                }
            }
        </style>
    </head>
    <body class="min-h-screen flex flex-col justify-center items-center p-4">
        <!-- Logo Principal -->
        <div class="logo-container mb-8">
            <a href="/" class="flex items-center justify-center">
                <img src="/img/logohorizontal.png" alt="Shopp Reparos" class="h-16 w-auto object-contain">
            </a>
        </div>

        <!-- Card de Autenticação -->
        <div class="auth-card w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white text-center font-display">
                    @if(request()->routeIs('login'))
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Acesse sua conta
                    @elseif(request()->routeIs('register'))
                        <i class="fas fa-user-plus mr-2"></i>
                        Crie sua conta
                    @endif
                </h2>
            </div>
            
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-white/80 text-sm">
                &copy; {{ date('Y') }} <span class="font-semibold">Shopp Reparos</span>. 
                Todos os direitos reservados.
            </p>
            <div class="flex justify-center space-x-4 mt-3">
                <a href="/" class="text-white/70 hover:text-white transition-colors text-sm">
                    <i class="fas fa-home mr-1"></i>Voltar ao site
                </a>
                <a href="/contato" class="text-white/70 hover:text-white transition-colors text-sm">
                    <i class="fas fa-envelope mr-1"></i>Contato
                </a>
            </div>
        </div>
    </body>
</html>
