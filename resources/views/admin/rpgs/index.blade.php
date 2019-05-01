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
        $('#datatables').dataTable({
            processing: true,
            bLengthChange: false,
            ajax: 'rpgs/',
            columns: [
                {'data': 'title'},
                {render: renderStart},
            ]
        });

        function renderStart(data, type, row){
            let url = 'rpgs/'+row.slug;
            return  `<a class='btn btn-success' href='${url}'><span class="fa fa-play"></span></a>`;
        }
    </script>
@endsection