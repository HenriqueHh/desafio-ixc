<h5 id="balance" style="font-size: 20px" class="description-header">
    <i id="toggle-icon" class="fas fa-eye" style="cursor: pointer"></i>
    <span id="balance-value">R$ {{ number_format($Usu_Conta->Usu_ContaSaldo, 2, ',', '.') }}</span>
    <span id="hidden-balance" style="display: none">-----------</span>
</h5>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#toggle-icon').on('click', function() {
        var balanceValue = $('#balance-value');
        var hiddenBalance = $('#hidden-balance');
        if (balanceValue.is(':visible')) {
            balanceValue.hide();
            hiddenBalance.show();
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            balanceValue.show();
            hiddenBalance.hide();
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
