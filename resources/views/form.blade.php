<!DOCTYPE html>
<html lang="en" class="box-border m-0 p-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Proximo - Estacionamento para visitas</title>
    <link rel="shortcut icon" href="img/favicon-16x16.png">
</head>
<body class="bg-gray-100 bg-cover bg-center h-auto w-auto p-0 m-0 flex flex-col min-h-screen">
    <header class="flex bg-white w-full pb-5 px-3 pt-2 items-center fixed mb-20">
        <a href="index.html"><div><img src="img/proximo_preto.svg" alt="Proximo Logo"></div></a>
        <nav class="ml-auto">
            <ul class="flex justify-around">
                    <li class="mx-5"><a class="text-xl" href="index.html">Formulario</a></li>
                    <li class="mx-5"><a class="text-xl" href="tabela.html">Tabela</a></li>
            </ul>
        </nav>
    </header>
    <div class="mb-[2%]"></div>
    <main class="flex-grow text-lg flex justify-center items-center flex-col">
        <div>
            <h1 class="text-4xl flex justify-center items-center px-45 pt-20 bg-white rounded-xl rounded-b-none font-bold">Formulario</h1>
            <form class="bg-white px-30 py-20 rounded-xl rounded-t-none flex justify-center items-center flex-col">
                <input type="text" placeholder="Nome" class="border p-1 mb-2 block" required>
                <input type="text" minlength="6" placeholder="Matricula" class="border p-1 mb-2 block" required>
                <select class="border p-1 mb-2 block" required>
                    <option disabled selected value="">Escolha a empresaㅤㅤ</option>
                    <option value="option1">Empresa aqui</option>
                    <option value="option2">Proximo</option>
                    <option value="option3">Telmo</option>
                    <option value="option4">blablabla</option>
                </select>
                
                <select class="border p-1 mb-2 block" required>
                    <option disabled selected value="">Escolhe segurançaㅤㅤ</option>
                    <option value="option5">Telmo</option>
                    <option value="option6">Ruben</option>
                    <option value="option7">Rafael</option>
                    <option value="option8">Maria</option>
                    <option value="option9">Queiros</option>
                    <option value="option10">Nicholas</option>
                    <option value="option11">João</option>
                    <option value="option12">Nuno</option>
                    <option value="option13">Pedro</option>
                    <option value="option14">Venâncio</option>
                    <option value="option15">AG1</option>
                    <option value="option16">Young Stitch</option>
                </select>
                <button type="submit" class="bg-sky-900 text-white px-2 p-1">Enviar</button>
            </form>
        </div>
    </main>
    <footer class="bg-white flex justify-center p-5 items-center">
        <p class="flex items-center">2025 © Proside, Lda Todos os direitos reservados | Proximo® é uma marca registada da Proside</p>
    </footer>

    
</body>
</html>