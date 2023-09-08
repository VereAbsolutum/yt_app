function get_transcription(videoId) {
    // Substitua 'YOUR_API_KEY' pela sua chave de API do YouTube
    const API_KEY = 'YOUR_API_KEY';

    // URL da API do YouTube para obter a transcrição do vídeo
    const apiUrl = `https://www.googleapis.com/youtube/v3/captions?part=snippet&videoId=${videoId}&key=${API_KEY}`;

    // Faça uma solicitação GET para a API do YouTube
    fetch(apiUrl)
        .then((response) => response.json())
        .then((data) => {
            // Verifique se há erros na resposta
            if (data.error) {
                console.error('Erro ao obter a transcrição do vídeo:', data.error);
                return;
            }

            // Obtenha a ID da legenda (closed caption) do vídeo, se disponível
            const captionId = data.items.length > 0 ? data.items[0].id : null;

            if (!captionId) {
                console.error('Este vídeo não possui legenda disponível.');
                return;
            }

            // URL da API do YouTube para obter o texto da transcrição
            const captionTextUrl = `https://www.googleapis.com/youtube/v3/captions/${captionId}?key=${API_KEY}`;

            // Faça uma solicitação GET para obter o texto da transcrição
            fetch(captionTextUrl)
                .then((response) => response.text())
                .then((transcriptText) => {
            // A transcrição
