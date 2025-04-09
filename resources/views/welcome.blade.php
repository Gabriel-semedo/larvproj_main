<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center bg-white p-10 shadow-md rounded-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Bem-vindo ao Sistema</h1>
        <p class="text-gray-600 mb-6">Clique no botão abaixo para aceder a alguma lista</p>
        
        <a href="{{ route('visits.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
            Ver Visitas
        </a>
        <a href="{{ route('companies.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
            Ver Empresas
        </a>
        <a href="{{ route('users.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
            Ver Utilizadores
        </a>
    </div>
</body>
</html>
