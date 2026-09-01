@extends('layouts.site')

@section('title', 'Contato - Shopp Reparos')
@section('description', 'Entre em contato com a Shopp Reparos. Assistência técnica e produtos hidráulicos em Águas Claras e Taguatinga.')

@section('content')
<main class="container mx-auto px-4 py-12">
    <!-- Header da página -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-gray-900">
            Entre em Contato
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Estamos aqui para ajudar você com suas necessidades em assistência técnica e produtos hidráulicos
        </p>
    </div>

    <!-- Informações de Contato -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <!-- Informações -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-3xl font-bold text-blue-700 mb-8">Informações de Contato</h2>
            
            <div class="space-y-6">
                <!-- Email -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-envelope text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                        <p class="text-gray-600">contato@shoppreparos.com.br</p>
                    </div>
                </div>

                <!-- Telefone -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-phone text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Telefone</h3>
                        <p class="text-gray-600">(61) 99931-8077</p>
                    </div>
                </div>

                <!-- Horário -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-clock text-2xl text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Horário de Atendimento</h3>
                        <p class="text-gray-600">Segunda a Sexta: 8h às 18h</p>
                        <p class="text-gray-600">Sábado: 8h às 12h</p>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center">
                        <i class="fab fa-whatsapp text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">WhatsApp</h3>
                        <a href="https://wa.me/5561999318077" class="text-green-600 hover:text-green-700 font-medium">
                            (61) 99931-8077
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulário -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-3xl font-bold text-blue-700 mb-8">Envie uma Mensagem</h2>
            
            <form action="/contato" method="POST" class="space-y-6">
                @csrf
                
                <!-- Nome -->
                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                    <input type="text" 
                           id="nome" 
                           name="nome" 
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Digite seu nome completo">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Digite seu email">
                </div>

                <!-- Telefone -->
                <div>
                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                    <input type="tel" 
                           id="telefone" 
                           name="telefone" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="(61) 99999-9999">
                </div>

                <!-- Assunto -->
                <div>
                    <label for="assunto" class="block text-sm font-medium text-gray-700 mb-2">Assunto</label>
                    <select id="assunto" 
                            name="assunto" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Selecione um assunto</option>
                        <option value="assistencia-tecnica">Assistência Técnica</option>
                        <option value="produtos">Produtos</option>
                        <option value="orcamento">Orçamento</option>
                        <option value="duvida">Dúvida</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <!-- Mensagem -->
                <div>
                    <label for="mensagem" class="block text-sm font-medium text-gray-700 mb-2">Mensagem</label>
                    <textarea id="mensagem" 
                              name="mensagem" 
                              required 
                              rows="5" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none"
                              placeholder="Digite sua mensagem..."></textarea>
                </div>

                <!-- Botão -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-4 px-6 rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Enviar Mensagem
                </button>
            </form>
        </div>
    </div>

    <!-- Nossas Lojas -->
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">Nossas Lojas</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Águas Claras -->
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-blue-700 mb-3">Águas Claras</h3>
                <p class="text-gray-600 mb-4">Q 204 Alfa Mix Loja 15A<br>Águas Claras - DF</p>
                <a href="https://wa.me/5561996096296" 
                   class="inline-flex items-center justify-center bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition-all duration-300 gap-2">
                    <i class="fab fa-whatsapp"></i>
                    <span>(61) 99609-6296</span>
                </a>
            </div>

            <!-- Taguatinga -->
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-2xl text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-blue-700 mb-3">Taguatinga</h3>
                <p class="text-gray-600 mb-4">St. E Sul CSE 2<br>Taguatinga Sul - DF</p>
                <a href="https://wa.me/5561999318077" 
                   class="inline-flex items-center justify-center bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition-all duration-300 gap-2">
                    <i class="fab fa-whatsapp"></i>
                    <span>(61) 99931-8077</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection 