<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SENAI</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
      .font-inter {
          font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body>
<body class="font-inter">
    <div class="bg-cover bg-center h-screen w-full" style="background-image: url('img/industria_1.jpg');">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <!-- Margens laterais em telas menores que 640px -->
            <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-2xl text-left font-semibold mb-0">Bem vindo a</h2>
                <h1 class="text-3xl text-left text-red-600 font-semibold mb-2">SECRETARIA VIRTUAL</h1>
                <div class="border-b-2 border-red-600 w-full mx-auto mb-5"></div>
    <!-- Exibe mensagens de erro se houver -->
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Formulário de login -->
    <form action="{{ route('funcionarios.autenticar') }}" method="POST">
        @csrf <!-- Gera um token CSRF para proteger o formulário -->

        <div class="mb-4">
        <label for="cpf_nif" class="block text-sm font-medium text-gray-700">CPF ou NIF:</label>
        <input type="text" id="cpf_nif" name="cpf_nif" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div class="mb-6">
        <label for="senha" class="block text-sm font-medium text-gray-700">Senha:</label>
        <input type="password" id="senha" name="senha" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div class="mt-6">
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Login</button>
        </div>

    </form>
            </div>
        </div>
    </div>
</body>
</html>