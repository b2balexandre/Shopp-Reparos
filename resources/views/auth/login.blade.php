<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-blue-500"></i>
                E-mail
            </label>
            <input id="email" 
                   class="form-input w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username" 
                   placeholder="Digite seu e-mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-blue-500"></i>
                Senha
            </label>
            <input id="password" 
                   class="form-input w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password" 
                   placeholder="Digite sua senha" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">Lembrar de mim</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors" 
                   href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" 
                    class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold text-lg transition-all duration-300">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Entrar
            </button>
        </div>
        
        <!-- Register Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                Não tem uma conta? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors">
                    Registre-se aqui
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
