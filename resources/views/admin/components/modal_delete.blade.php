<div class="modal modal-danger fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $title !!}</h4>
            </div>

            <form action="{!! $action !!}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="modal_remove_id_delete">
                <div class="modal-body">
                    <p>{!! $text !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
