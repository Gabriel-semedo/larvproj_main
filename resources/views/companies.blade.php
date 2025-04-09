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
    <div class="max-w-7xl mx-auto p-6">
        
        
    
<div class="bg-gray-300 p-10 rounded-xl">    
    
    <div class="bg-gray-100 p-5 rounded-xl">
        <h1 class="text-center text-4xl font-bold text-gray-800 mb-8">Company Registration</h1>
        <h3 class="text-center text-xl text-gray-600 mb-6">Company Records Table</h3>
        <div class="overflow-x-auto shadow-lg rounded-lg">
          <table class="table-auto w-full border-collapse bg-white rounded-lg">
            <thead class="bg-gray-200 text-gray-700">
              <tr>
                <th class="border border-gray-300 px-6 py-3 text-left">ID</th>
                <th class="border border-gray-300 px-6 py-3 text-left">Name</th>
                <th class="border border-gray-300 px-6 py-3 text-left">Actions</th>
              </tr>
            </thead>
            <tbody id="t-body" class="text-gray-800">
            </tbody>
          </table>
        </div>
      </div>
      <div>
      <button onclick="hideShow()" class="p-2 mt-2 mb-2 bg-sky-700 rounded-lg text-white">
        Add company
    </button>
      </div>
      <div class="toggleShow" id="toggleShow">
      <div id="div2"class="bg-gray-200 rounded-2xl px-5 flex items-center py-2">
        <script>
            document.getElementById("div2").style.display = "none";
        </script>
        <form action="" class="flex items-center ">
         <input type="text" placeholder="Insert the company name" class="bg-gray-300 p-1 pr-[50px] block rounded-3xl px-9"> 
         <button onclick="showWarning()" type="submit" class="p-1 bg-green-700 rounded-xl ml-2 px-2">
            ✅
          </button>
          <button onclick="hideShow()" class="p-1 bg-red-700 rounded-xl ml-2 px-2">
            ❌
          </button>  
        </form> 
      </div>
    </div>
</div>
</div>    
      <script>
        
        var div = document.getElementById("div2");
        var display = 1;

        function hideShow()
        {
            if(display == 1)
            {
                div.style.display = 'block';
                display = 0;
            }
            else
            {
                div.style.display = 'none';
                display = 1;
            }
        }

        function showWarning() {
            alert("Company was sucessfully added!");
        }

        const visitData = [
          { name: "Global Imagem - Publicidade e Imagem", actions: "placeholder? yes it is a placeholder dont judge me"},
        ];
  
        let ID = 1;
  
        function createRow({ name, actions}) {
          return `
            <tr class="hover:bg-gray-100">
              <td class="border border-gray-300 px-6 py-3">${ID++}</td>
              <td class="border border-gray-300 px-6 py-3">${name}</td>
              <td class="border border-gray-300 px-6 py-3">${actions}</td>
            </tr>
          `;
        }
  
        const tableBody = document.getElementById("t-body");
        tableBody.innerHTML = visitData.map(createRow).join("");
      </script> 
</main>
    <footer class="bg-white flex justify-center p-5 items-center">
        <p class="flex items-center">2025 © Proside, Lda Todos os direitos reservados | Proximo® é uma marca registada da Proside</p>
    </footer>
</body>
</html>