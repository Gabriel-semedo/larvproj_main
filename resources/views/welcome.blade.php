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
        <p class="text-gray-600 mb-6">Clique no botão abaixo para aceder à lista de Empresas</p>
        <button id="companyButton" class="bg-blue-500 text-white px-4 py-2 rounded">Aceder à Lista de Empresas</button>
    </div>
    <script>
        document.getElementById('companyButton').addEventListener('click', function() {
            window.location.href = '/companies'; // Substitua pela rota correta
        });
    </script>
</body>
</html>