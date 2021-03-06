<div class="modal fade" id="modal-edit-player" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Dados</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="xp_adquired">Adicionar Pontos de experiência</label>
                            <input type="number" class="form-control" id="xp_adquired" name="xp_adquired" min="1"
                                   placeholder="Quantidade de pontos de experiência para atribuir ao jogador">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="life">Pontos de Vida <small>(Quantidade de pontos que deseja aumentar/diminuir.)</small></label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="life_player" name="life"
                                       placeholder="Para aumentar: Número | Para dimuir: -NUMERO">
                                <span class="input-group-addon" id="max_life_player">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="mana">Pontos de Mana <small>(Quantidade de pontos que deseja aumentar/diminuir.)</small></label>
                            <div class="input-group">
                                <input type="number" name="mana" id="mana_player" class="form-control"
                                       placeholder="Para aumentar: Número | Para dimuir: -NUMERO">
                                <span class="input-group-addon" id="max_mana_player">0</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Fechar</button>
                <button class="btn btn-success" data-cardid="0" id="btnUpdateDataPlayer" type="button">Salvar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
