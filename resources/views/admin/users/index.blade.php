@extends('adminlte::page')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-heading"></div>
        
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="datatable" style="width: 100%">
                    <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Email</td>
                        <td>Nivel de Acesso</td>
                        <td>Editar</td>
                        <td>Excluir</td>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $('#datatable').DataTable({
            ordering: false,
            processing: true,
            serverSide: false,
            ajax: '{!! route('admin.users.index') !!}',
            columns: [
                {data: 'name'},
                {data: 'email'},
            ]

        });
    </script>
@endsection