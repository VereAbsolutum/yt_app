// web/js/get_transcript.js

function getYouTubeTranscript(videoId) {
    // Substitua 'SUA_CHAVE_DA_API' pela sua chave de API do YouTube
    var apiKey = 'SUA_CHAVE_DA_API';

    // URL da API do YouTube para obter informações do vídeo, incluindo o transcript
    var apiUrl = 'https://www.googleapis.com/youtube/v3/videos?id=' + videoId + '&key=' + apiKey + '&part=snippet&fields=items(snippet(transcript))';

    // Faça uma solicitação AJAX para a API do YouTube
    $.ajax({
        url: apiUrl,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.items && data.items.length > 0) {
                var transcript = data.items[0].snippet.transcript;

                // Atualize o campo de texto 'texto' na página com o transcript
                $('#texto').val(transcript);
            } else {
                console.log('O vídeo não foi encontrado ou não possui transcript.');
            }
        },
        error: function (error) {
            console.error('Ocorreu um erro ao acessar a API do YouTube: ' + error.statusText);
        }
    });
}
