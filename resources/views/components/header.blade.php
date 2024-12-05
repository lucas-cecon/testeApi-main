<div class="container mx-auto pt-4 flex justify-between items-center w-11/12">
    <!-- Logo SENAI e Secretaria -->
    <div class="flex items-center">
        <!-- Logo SENAI -->
        <a href="{{ $logoUrl ?? url('') }}"><img src="{{ asset('assets/img/senai.svg') }}" alt="SENAI Logo" class="senai-logo"></a>
        <!-- Texto "Secretaria" -->
        <span class="secretaria-text">{{ $sectionTitle ?? 'Secretaria' }}</span>
    </div>
    <a href="{{ route('/perfil') }}">
        <button class="text-red-500 text-1xl font-black uppercase hover:underline">
            Ver Perfil
        </button>
    </a>
</div>

<div class="w-11/12 h-0.5 bg-red-500 mb-2"></div>
<div class="w-11/12 flex justify-between items-center mb-2">
    <!-- Título -->
    <h2 class="text-1xl text-red-500 font-black uppercase">
        {{ $pageTitle ?? 'Título Padrão' }}
    </h2>
</div>
<div class="w-11/12 h-0.5 bg-red-500 mb-4"></div>
