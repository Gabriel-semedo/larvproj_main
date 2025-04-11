@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($visit) ? 'Editar Visita' : 'Nova Visita' }}</h1>

        <form action="{{ isset($visit) ? route('visits.update', $visit->id) : route('visits.store') }}" method="POST">
            @csrf
            @if(isset($visit))
                @method('PUT')
            @endif

            <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $visit->name ?? '') }}" required>
            </div>

            <div class="mb-3">
            <label for="plate" class="form-label">Matrícula</label>
            <input id="plate" type="text" name="plate" class="form-control" value="{{ old('plate', $visit->plate ?? '') }}" required>
            </div>

            <div class="mb-3">
    <label for="company" class="form-label">Empresa</label>
    <select id="company" name="company" class="form-control" required>
        @foreach($companies as $company)
            <option value="{{ $company->id }}" {{ old('company', $visit->company ?? '') == $company->id ? 'selected' : '' }}>
                {{ $company->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="user" class="form-label">Utilizador</label>
    <select id="user" name="user" class="form-control" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user', $visit->user ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>


            <!-- Botão para tirar a foto -->
            <button type="button" id="captureBtn" class="btn btn-primary">Tirar Foto</button>

            <div id="camera" style="display: none;">
                <video id="video" width="320" height="240" autoplay></video>
                <button type="button" id="snapBtn" class="btn btn-success">Capturar</button>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('visits.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        // Obtém os elementos
        const captureBtn = document.getElementById('captureBtn');
        const cameraDiv = document.getElementById('camera');
        const video = document.getElementById('video');
        const snapBtn = document.getElementById('snapBtn');
        const plateInput = document.getElementById('plate');
        
        let localStream;

        // Função para iniciar a câmera
        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    localStream = stream;
                    video.srcObject = stream;
                    cameraDiv.style.display = 'block';
                    captureBtn.disabled = true;
                })
                .catch(function (error) {
                    alert('Erro ao acessar a câmera: ' + error);
                });
        }

        // Quando o botão de capturar for pressionado
    snapBtn.addEventListener('click', function () {
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    const dataUrl = canvas.toDataURL('image/jpeg'); // Convertendo para base64

    fetch('{{ route('ocr.matricula') }}', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
    },
    body: JSON.stringify({ image: dataUrl }),
})
.then(response => {
    // Verifica se a resposta é JSON
    if (!response.ok) {
        return response.text().then(text => { throw new Error(text); });
    }
    return response.json();
})
.then(data => {
    if (data.text) {
        plateInput.value = data.text;
    } else {
        alert('Não foi possível ler a matrícula.');
    }
})
.catch(error => {
    console.error('Erro ao processar a imagem:', error);
    alert('Erro ao processar a imagem.');
});


    // Fecha a câmera após capturar a imagem
    localStream.getTracks().forEach(track => track.stop());
    cameraDiv.style.display = 'none';
});


        // Iniciar a câmera ao clicar no botão
        captureBtn.addEventListener('click', startCamera);
    </script>

@endsection


