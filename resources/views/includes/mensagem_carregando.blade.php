<style>

    /* Estilo para a div de sobreposição de carregamento */
    .loading-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    color: #fff;
    text-align: center;
    padding-top: 50vh;
    }

    /* Estilo para o spinner de carregamento */
    .loading-spinner {
    display: inline-block;
    width: 40px;
    height: 40px;
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top: 4px solid #fff;
    animation: spin 1s linear infinite;
    }

    /* Animação para o spinner de carregamento */
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Função para mostrar a mensagem de carregamento
    function showLoadingMessage() {
        $('#loadingOverlay').fadeIn();
    }

    // Função para ocultar a mensagem de carregamento
    function hideLoadingMessage() {
        $('#loadingOverlay').fadeOut();
    }

    // Associar a função à ação de submit do formulário
    $('form').on('submit', function(event) {
    //   event.preventDefault(); // Impede o envio do formulário
        showLoadingMessage(); // Chama a função para mostrar a mensagem de carregamento
        $('button[type="submit"]').prop('disabled', true);
        // Aqui, você pode executar quaisquer outras ações necessárias antes de enviar o formulário

        // Em algum momento, quando estiver pronto para enviar o formulário, faça:
        // $('form').unbind('submit').submit(); // Desfaz a ação do preventDefault e envia o formulário
        // Ao finalizar o envio do formulário ou após algum tempo, chame a função para ocultar a mensagem de carregamento:
        // hideLoadingMessage();
    });

    });
</script>

<!-- Adicione esta div no início da página (antes do seu conteúdo principal) -->
<div id="loadingOverlay" class="loading-overlay">
    <img style="margin-top: -50px" height="35%" width="20%" src="{{ URL::to('../public/vendor/adminlte/dist/img/LogoFinestra_PNGPEQUENA.png') }}" alt="Imagem responsiva">
    <br >
    {{-- <div style="margin: 15px; color: rgb(7, 192, 248)" class="loading-spinner"></div> --}}

    <div class="spinner-border" style="color: rgb(7, 192, 248); margin: 15px" role="status">
        <span class="sr-only" >Loading...</span>
    </div>

    <p>Carregando... Aguarde até finalizar!</p>

</div>
