<div class="modal fade" id="modal-menu-actions" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Menu de Ações</h4>
            </div>
            <div class="modal-body">
                @if($controlRpg)
                    <a class="btn btn-app" disabled>
                        <i class="fa fa-play"></i> Iniciar Sessão
                    </a>

                    <a class="btn btn-app" disabled>
                        <i class="fa fa-pause"></i> Finalizar Sessão
                    </a>

                    <a class="btn btn-app" disabled>
                        <i class="fa fa-stop"></i> Encerrar RPG
                    </a>

                    <br>

                    <a class="btn btn-app">
                        <i class="fa fa-user-plus"></i> Adicionar NPC
                    </a>
                @endif

                <a class="btn btn-app">
                    <i class="fa fa-map"></i> Mapa
                </a>

                @if($controlRpg)
                    <a class="btn btn-app">
                        <i class="fa fa-map-pin"></i> Adicionar Mapa
                    </a>

                    <br>

                    <a class="btn btn-app">
                        <i class="fa fa-clock-o"></i> Descansar
                    </a>
                @endif

                <a class="btn btn-app">
                    <i class="fa fa-sticky-note-o"></i> Lembretes
                </a>

                <a class="btn btn-app">
                    <i class="fa fa-book"></i> Objetivos
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
