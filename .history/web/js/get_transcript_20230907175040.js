// Função para obter a transcrição de um vídeo do YouTube
function obterTranscricao(videoId) {
    fetch('http://SEU_SERVIDOR_FLASK/get_transcript', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ video_id: videoId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.transcript) {
                // Use a transcrição retornada, por exemplo, exibindo-a em uma caixa de texto
                document.getElementById('transcriptTextArea').value = data.transcript;
            } else {
                console.error('Erro ao obter transcrição:', data.error);
            }
        })
        .catch((error) => {
            console.error('Erro na solicitação:', error);
        });
}

// Chame a função para obter a transcrição de um vídeo específico
obterTranscricao('VIDEO_ID'); // Substitua 'VIDEO_ID' pelo ID do vídeo do YouTube desejado
