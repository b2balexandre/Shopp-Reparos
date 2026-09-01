<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-user mr-2 text-blue-500"></i>
                Nome completo
            </label>
            <input id="name" 
                   class="form-input w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   placeholder="Digite seu nome completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
        </div>

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
                   autocomplete="new-password" 
                   placeholder="Digite sua senha" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-blue-500"></i>
                Confirmar senha
            </label>
            <input id="password_confirmation" 
                   class="form-input w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Confirme sua senha" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" 
                    class="btn-primary w-full py-3 px-4 rounded-lg text-white font-semibold text-lg transition-all duration-300">
                <i class="fas fa-user-plus mr-2"></i>
                Criar conta
            </button>
        </div>
        
        <!-- Login Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                Já tem uma conta? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors">
                    Faça login aqui
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
