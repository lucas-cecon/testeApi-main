<div class="container mx-auto pt-4 flex justify-between items-center w-11/12">
    <!-- Logo SENAI e Secretaria -->
    <div class="flex items-center">
        <!-- Logo SENAI -->
        <a href="{{url('')}}"><img src="{{ asset('assets/img/senai.svg') }}" alt="SENAI Logo" class="senai-logo"></a>
        <!-- Texto "Secretaria" -->
        <span class="secretaria-text">{{ $sectionTitle ?? 'Secretaria' }}</span>
    </div>
</div>
<div class="w-11/12 h-0.5 bg-red-500 mb-2"></div>
<div class="w-11/12 items-center mb-2"> <!-- Ajusta a posição -->
    <h2 class="text-3x2 text-red-500 font-black uppercase">{{ $pageTitle ?? 'Título Padrão' }}</h2> <!-- Título acima da linha vermelha -->
</div>
<div class="w-11/12 h-0.5 bg-red-500 mb-4"></div>