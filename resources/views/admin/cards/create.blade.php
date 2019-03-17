@extends('adminlte::page')

@section('content')
    <div class="box">
        <div class="box-header">
            <h4>Criação de Personagem</h4>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="box-body">

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="form-group">
                            {{--src="https://i.imgur.com/dGo8DOk.png"--}}
                            <input type="file" class="user dropify"
                                   data-default-file="https://i.imgur.com/dGo8DOk.png"
                                   data-height="200">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-2">Nome do Personagem</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Nome do seu personagem para essa aventura">
                    </div>
                </div>

                <div class="form-group">
                    <label for="race" class="col-sm-2">Raça</label>
                    <div class="col-sm-10">
                        <select name="race" id="race" class="form-control">
                            <option value="#" selected disabled>Raça do seu personagem</option>
                            @foreach($races as $race)
                                <option value="{{$race}}">{{$race}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="race" class="col-sm-2">Sub-Raça</label>
                    <div class="col-sm-10">
                        <select name="race" id="race" class="form-control">
                            <option value="#" selected disabled>Selecione a sub-raça do seu personagem(caso tenha uma)</option>
                            @foreach($races as $race)
                                <option value="{{$race}}">{{$race}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="personalidade" class="col-sm-2">Personalidade</label>
                    <div class="col-sm-10">
                        <textarea name="personalidade" id="personalidade" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <hr>
                <h4>
                    Atributos
                </h4>
                <div class="form-group">
                    <label for="forca" class="col-sm-2">Força</label>
                    <div class="col-sm-10 input-group">
                        <input type="text" class="form-control" id="forca">
                        <span class="input-group-addon">.00</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="destreza" class="col-sm-2">Destreza</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="destreza">
                    </div>
                </div>

                <div class="form-group">
                    <label for="constituicao" class="col-sm-2">Constituição</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="constituicao">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sabedoria" class="col-sm-2">Sabedoria</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sabedoria">
                    </div>
                </div>

                <div class="form-group">
                    <label for="carisma" class="col-sm-2">Carisma</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="carisma">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inteligencia" class="col-sm-2">Inteligência</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inteligencia">
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <button class="btn btn-success pull-right"><span class="fa fa-check"></span> Criar</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $('.dropify').dropify();
    </script>
@endsection

@section('css')
    <style>
        .user {
            display: inline-block;
            width: 150px;
            height: 150px;
            border-radius: 50%;

            object-fit: cover;
        }

        .col-centered{
            margin: 0 auto;
            float: none;
        }
    </style>
@endsection