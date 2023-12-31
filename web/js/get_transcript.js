function get_transcript(video, API_KEY) {
    const videoId = extractVideoIdFromUrl(video);
    const serverPort = 5000;

    return fetch(`http://localhost:${serverPort}/get_transcript/${videoId}`)
        .then((response) => {
            console.log(response)
            if (!response.ok) {
                throw new Error('Erro na solicitação.');
            }
            return response.json();
        })
        .then((data) => {
            if (data.transcript) {
                return data.transcript;
            } else {
                throw new Error('Erro ao obter transcrição:' + data.error);
            }
        })
        .catch((error) => {
            console.error('Erro:', error);
            throw error; // Rejeita a promessa com o erro
        });
}

// Função para extrair o ID do vídeo da URL do YouTube
function extractVideoIdFromUrl(url) {
    const urlParams = new URLSearchParams(new URL(url).search);
    return urlParams.get('v');
}




    // if (!video) {
    //     return
    // }

    // const urlParams = new URLSearchParams(new URL(video).search);

    // videoId = urlParams.get('v');

    // // URL da API do YouTube para obter a transcrição do vídeo
    // const apiUrl = `https://www.googleapis.com/youtube/v3/captions?part=snippet&videoId=${videoId}&key=${API_KEY}`;

    // // Faça uma solicitação GET para a API do YouTube
    // fetch(apiUrl)
    //     .then((response) => response.json())
    //     .then((data) => {
    //         // Verifique se há erros na resposta
    //         if (data.error) {
    //             console.error('Erro ao obter a transcrição do vídeo:', data.error);
    //             return;
    //         }

    //         // Obtenha a ID da legenda (closed caption) do vídeo, se disponível
    //         const captionId = data.items.length > 0 ? data.items[0].id : null;

    //         if (!captionId) {
    //             console.error('Este vídeo não possui legenda disponível.');
    //             return;
    //         }

    //         // URL da API do YouTube para obter o texto da transcrição
    //         const captionTextUrl = `https://www.googleapis.com/youtube/v3/captions/${captionId}?key=${API_KEY}`;

    //         // Faça uma solicitação GET para obter o texto da transcrição
    //         fetch(captionTextUrl)
    //             .then((response) => response.text())
    //             .then((transcriptText) => {
    //                 // A transcrição estará em 'transcriptText'
    //                 console.log('Transcrição do vídeo:', transcriptText);
    //                 return transcriptText;

    //                 // Agora você pode integrar 'transcriptText' em seu projeto Yii2 conforme necessário
    //             })
    //             .catch((error) => {
    //                 console.error('Erro ao obter o texto da transcrição:', error);
    //             });
    //     })
    //     .catch((error) => {
    //         console.error('Erro na solicitação da API do YouTube:', error);
    //     });
// }
