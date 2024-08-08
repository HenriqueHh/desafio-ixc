<script>
    // Função para formatar o CNPJ (apenas números, sem pontos, traços e barras)
    function formatarCNPJ(cnpj) {
        cnpj = cnpj.replace(/\D/g, '');
        cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
        cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2');
        cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2');
        return cnpj;
    }

    // Event listener para formatar o CNPJ ao digitar
    document.addEventListener('input', function (event) {
        if (event.target.classList.contains('cnpj')) {
            event.target.value = formatarCNPJ(event.target.value);
            // Limitar a quantidade de caracteres para 18
            if (event.target.value.length > 18) {
                event.target.value = event.target.value.slice(0, 18);
            }
        }
    });
</script>
