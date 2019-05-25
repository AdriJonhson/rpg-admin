<div class="modal fade" id="modal-edit-status" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Status</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="status-type">Tipo de Status</label>
                    <select id="status-type" class="form-control select2 select2-hidden-accessible"
                            name="status-type"
                            data-placeholder="Status que já foram usados nessa Aventura"
                            style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value=""></option>
                        <option>Envenenamento</option>
                        <option>Maldição</option>
                        <option>Novo Status</option>
                    </select>
                </div>

                <div class="status-info" hidden>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Nome do status</label>
                            <input type="text" id="status-name" class="form-control" placeholder="Nome para o status">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Duração</label>
                            <input type="text" id="status-duration" class="form-control" placeholder="Duração em turnos">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="">Dano</label>
                            <input type="text" id="status-damage" class="form-control" placeholder="Dano por tuno">
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="status-active" name="status-active" value="1">
                        <label class="form-check-label" for="status-active">Ativo em todos os turnos</label>
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
