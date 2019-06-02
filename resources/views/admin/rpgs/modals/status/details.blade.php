<div class="modal fade" id="modal-details-status" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalhes Status</h4>
            </div>
            <div class="modal-body" style=" max-height: calc(100% - 120px); overflow-y: scroll;">

                <div class="status-info">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="">Nome do status</label>
                            <input type="text" id="status-name-details" disabled class="form-control" placeholder="Nome para o status">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="">Duração</label>
                            <input type="text" id="status-duration-details" disabled class="form-control" placeholder="Duração em turnos">
                        </div>
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

                                    <tbody id="tbodyStatusDetails">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
