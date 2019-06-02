<div class="modal fade" id="modal-add-status" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" style="height: 80%;">
        <div class="modal-content" style="height: 80%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Status</h4>
            </div>
            <div class="modal-body" style=" max-height: calc(100% - 120px); overflow-y: scroll;">

                <div class="status-info">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Nome do status</label>
                            <input type="text" id="status-name" class="form-control" placeholder="Nome para o status">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="">Duração</label>
                            <input type="text" id="status-duration" class="form-control" placeholder="Duração em turnos">
                        </div>
                    </div>


                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="status-active" name="status-active" value="1">
                        <label class="form-check-label" for="status-active">Ativo em todos os turnos</label>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Efeitos</label>
                            <div class="table">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Atributo</th>
                                        <th>Valor</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($statusEffects as $index => $value)
                                        <tr>
                                            <td>{!! $value !!}</td>
                                            <td><input type="number" id="status-{!! $index !!}" class="form-control" value="0"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Fechar</button>
                <button class="btn btn-success" data-card="0" id="btnAddStatusToCard" type="button">Salvar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
