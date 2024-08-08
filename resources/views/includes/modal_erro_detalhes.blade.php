<a data-toggle="modal" data-target="#ModalErro" class="btn" data-toggle="tooltip" data-placement="top">Ver Detalhes</a>
<div class="modal fade" id="ModalErro" tabindex="-1" role="dialog" aria-labelledby="ModalProdutoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black" class="modal-title" id="ModalProdutoTitle">Descrição Erro:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h6 style="color: black; margin-left: 10px">Contate o Administrador monstrando a mensagem abaixo</h6>
            <div class="modal-body" style="color: black">
                {{Session::get('descricao_erro')}}
            </div>
        </div>
    </div>
</div>
