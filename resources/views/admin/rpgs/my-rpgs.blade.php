@extends('adminlte::page')

@section('content_header')
    <h1>RPGS</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table" id="datatables" style="width: 100%">
                    <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Iniciar</td>

                        <td>Adicionar Jogador</td>
                        <td>Editar</td>
                        <td>Excluir</td>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-success" data-toggle="modal" data-target="#modal-create"><span class="fa fa-plus"></span> Nova Aventura</button>
        </div>
    </div>

    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nova Aventura</h4>
                </div>
                <form action="{!! route('rpg.store') !!}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titulo dessa aventura" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descriçao</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Descriçao dessa aventura" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Nova Aventura</h4>
                </div>
                <form action="{!! route('rpg.store') !!}" method="POST" id="form-edit">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title_edit">Titulo</label>
                            <input type="text" class="form-control" id="title_edit" name="title" placeholder="Titulo dessa aventura" required>
                        </div>

                        <div class="form-group">
                            <label for="description_edit">Descriçao</label>
                            <textarea class="form-control" id="description_edit" name="description" placeholder="Descriçao dessa aventura" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-player">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Adicionar Jogador</h4>
                </div>
                <form action="" method="POST" id="form-player">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="E-Mail do jogador que deseja adicionar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @include('admin.components.modal_delete', [
       'action' => route('rpg.delete'),
       'title' => 'Remover RPG',
       'text'  => 'Deseja realmente excluir esse RPG?'
   ])


@stop

@section('js')
    <script>
        $('#datatables').dataTable({
            processing: true,
            bLengthChange: false,
            ajax: 'my-rpgs/',
            columns: [
                {'data': 'title'},
                {render: renderStart},
                {render: renderAddPlayer},
                {render: renderEdit},
                {render: renderDelete},
            ]
        });

        function renderStart(data, type, row){
            let url = 'rpgs/'+row.slug;
            return  `<a class='btn btn-success' href='${url}'><span class="fa fa-play"></span></a>`;
        }

        function renderAddPlayer(data, type, row){
            return  `<button class='btn btn-info btn-add-player' data-rpg='${row.id}'><span class='fa fa-plus'></span></button>`;
        }

        function renderEdit(data, type, row){
            return  `<a class='btn btn-warning btn-edit' data-id='${row.id}' data-title='${row.title}' data-description='${row.description}'><span class='fa fa-pencil'></span></a>`;
        }

        function renderDelete(data, type, row){
            return  `<a class='btn btn-danger btn-remove' data-id='${row.id}'><span class='fa fa-trash'></span></a>`;
        }

        $('#datatables').on('click', '.btn-edit', function(){
            let title = $(this).data('title');
            let description = $(this).data('description');
            let id = $(this).data('id');

            let url = 'rpgs/edit/'+id;

            $('#title_edit').val(title);
            $('#description_edit').val(description);

            $('#form-edit').attr('action', url);

            $('#modal-edit').modal('show');
        });

        $('#modal-edit').on('hide.bs.modal', function(){
            $('#title_edit').val('');
            $('#description_edit').val('');
        });

        $('#datatables').on('click', '.btn-remove', function () {
            var id = $(this).data('id');
            $('#modal_remove_id_delete').val(id);
            $('#modal-delete').modal('show');
        });

        $('#modal-delete').on('hide.bs.modal', function(){
            $('#modal_remove_id_delete').val('');
        });

        $('#datatables').on('click', '.btn-add-player', function(){
            let rpg = $(this).data('rpg');
            let url = "rpgs/"+rpg+"/add-player";
            $('#form-player').attr('action', url);

            $('#modal-player').modal('show');
        })
    </script>
@endsection