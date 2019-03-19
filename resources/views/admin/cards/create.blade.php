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
                        <select name="sub-race" id="sub-race" class="form-control" disabled>
                            <option value="#" selected disabled>Selecione primeiramente uma raça</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="race" class="col-sm-2">Classe</label>
                    <div class="col-sm-10">
                        <select name="class" id="class" class="form-control">
                            <option value="#" selected disabled>Selecione a classe do seu personagem</option>
                            @foreach($classes as $class)
                                <option value="{{$class}}">{{$class}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="personalidade" class="col-sm-2">Personalidade</label>
                    <div class="col-sm-10">
                        <textarea name="personalidade" id="personalidade" cols="30" rows="10" class="form-control" placeholder="Personalidade"></textarea>
                    </div>
                </div>

                {{--ATRIBUTOS--}}
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Atributos</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#attibutes"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body" id="attibutes">
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Força" name="force" id="force">
                            <span class="input-group-addon">0</span>
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Destreza" name="skill" id="skill">
                            <span class="input-group-addon">0</span>
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Constituição" name="constitution" id="constitution">
                            <span class="input-group-addon">0</span>
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Sabedoria" name="sapience" id="sapience">
                            <span class="input-group-addon">0</span>
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Carisma" name="charisma" id="charisma">
                            <span class="input-group-addon">0</span>
                        </div>
                        <br>

                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Inteligência" name="intelligence" id="intelligence">
                            <span class="input-group-addon">0</span>
                        </div>
                        <br>
                    </div>
                </div>

                {{--Outros Dados--}}
                <div class="box box-success">
                    <div class="box-header">
                        <h4 class="box-title">Dados de Status</h4>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#status"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body" id="status">
                        <div class="form-group">
                            <label for="" class="col-sm-2">Pontos de Vida(HP)</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" placeholder="Quantidade de pontos de Vida">
                            </div>

                            <label for="" class="col-sm-2">Pontos de Magia(Mana)</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" placeholder="Quantidade de mana">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2">Constituiçao(CA</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" placeholder="Constituiçao">
                            </div>
                        </div>
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

        $('#race').on('change', function () {
            let race = $(this).val();

            let sub_races = $('#sub-race');

            sub_races.prop('disabled', false);
            sub_races.empty();

            if(race == "Anão"){
                sub_races.append("<option value='Anão Da Montanha'>Anão Da Montanha</option>");
                sub_races.append("<option value='Anão Da Colina'>Anão Da Colina</option>");
            }else if(race == "Elfo"){
                sub_races.append("<option value='Alto Elfo'>Alto Elfo</option>");
                sub_races.append("<option value='Elfo da Floresta'>Elfo da Floresta</option>");
                sub_races.append("<option value='Drow'>Drow</option>");
            }else if(race == "Halfling"){
                sub_races.append("<option value='Pés-Leves'>Pés-Leves</option>");
                sub_races.append("<option value='Robusto'>Robusto</option>");
            }else if(race == "Gnomo"){
                sub_races.append("<option value='Gnomo Das Rochas'>Gnomo Das Rochas</option>");
                sub_races.append("<option value='Gnomo Da Floresta'>Gnomo Da Floresta</option>");
            }else{
                sub_races.prop('disabled', true);
                sub_races.append("<option value='Gnomo Das Rochas' disabled selected>Essa raça nao possui nenhuma sub-raça</option>");
            }

        });

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