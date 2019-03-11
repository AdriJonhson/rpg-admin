@extends('adminlte::page')

@section('content_header')
    <h1>RPGS</h1>
@stop

@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table" id="datatable" style="width: 100%">
                    <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Iniciar</td>
                        @can('control_rpg')
                        <td>Adicionar Jogador</td>
                        <td>Editar</td>
                        <td>Excluir</td>
                        @endcan
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        @can('control_rpg')
            <div class="box-footer">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-create"><span class="fa fa-plus"></span> Novo RPG</button>
            </div>
        @endcan
    </div>

    @can('control_rpg')
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
                                <input type="text" class="form-control" id="title" name="title" placeholder="Titulo dessa aventura">
                            </div>

                            <div class="form-group">
                                <label for="title">Descriçao</label>
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
    @endcan
@stop

@section('js')
    <script>
        $('#datatable').DataTable({
            processing: true,
            bLengthChange: false,
            ajax: '/admin/rpgs/',
            columns: [
                {'data': 'title'},
                {render: renderStart},
                @can('control_rpg')
                {render: renderAddPlayer},
                {render: renderEdit},
                {render: renderDelete},
                @endcan
            ]
        });

        function renderStart(){
            return  `<a class='btn btn-success' href='#'><span class="fa fa-play"></span></a>`;
        }

        function renderAddPlayer(){
            return  `<a class='btn btn-info' href='#'><span class='fa fa-plus'></span></a>`;
        }

        function renderEdit(){
            return  `<a class='btn btn-warning' href='#'><span class='fa fa-pencil'></span></a>`;
        }

        function renderDelete(){
            return  `<a class='btn btn-danger' href='#'><span class='fa fa-trash'></span></a>`;
        }
    </script>
@endsection