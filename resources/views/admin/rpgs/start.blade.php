@extends('adminlte::page')

@section('content_header')

@stop

@section('css')
    <style>
        .img-responsive
        {
            height: 100px;
        }

        .btn-app
        {
            min-width: 100px;
        }
    </style>
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{!! $rpg->title !!}</h3>
            <button class="pull-right btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-menu-actions"><i class="fa fa-th"></i> Menu de Ações</button>
        </div>

        <div class="box-body">

            @forelse($cards as $card)

                @if($loop->index == 0)
                    <div class="row">
                        @endif
                        <div class="col-sm-3">
                            <img class="profile-user-img img-responsive img-circle"
                                 src="{!! $card->avatar_url ? url($card->avatar_url) : 'https://i.imgur.com/dGo8DOk.png' !!}"
                                 alt="Player-Avatar"
                                    {!! $card->status == \App\Models\Card::STATUS_LIVE ? 'style="border-color: #41f450"' : '' !!}
                                    {!! $card->status == \App\Models\Card::STATUS_DIE ? 'style="border-color: #fc0800"' : '' !!}
                                    {!! $card->model_id && $card->status == \App\Models\Card::STATUS_NEGATIVE ? 'style="border-color: #ffb200"' : '' !!}>

                            <h3 class="profile-username text-center" {!! auth()->user()->id == $card->model_id ? 'style="font-weight: bold"' : '' !!}>{{$card->name}}</h3>

                            <p class="text-muted text-center">{!! $card->race . ' | ' . ($card->sub_race ?  $card->sub_race . ' | ' : '' ) . $card->class !!}</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Nível</b> <a class="pull-right">{{ $card->level}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pontos de Vida</b> <a class="pull-right">{{ $card->health_point . '/' . $card->health_point }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pontos de Mana</b> <a class="pull-right">{{ $card->mana_point . '/' . $card->mana_point  }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Constituição</b> <a class="pull-right">{{ $card->constitution }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="pull-right">{{ $card->status == 'live' ? 'Normal' : $card->status}}</a>
                                </li>
                            </ul>

                            <div class="{!! $controlRpg ? 'btn-group' : '' !!}" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary btnShowDetails btn-flat {!! !$controlRpg ? 'btn-block' : '' !!}"
                                        data-cardid="{!! $card->id !!}"
                                        data-player="{!! $card->model_id !!}">
                                    <i class="fa fa-eye"></i> Detalhes</button>
                                @can('control_rpg')
                                    <button type="button" class="btn bg-orange btn-flat"><i class="fa fa-pencil"></i> Editar</button>
                                    <button type="button" class="btn bg-maroon btn-flat"><i class="fa fa-star"></i> Status</button>
                                @endcan
                            </div>
                        </div>

                        @if(($loop->index  + 1) % 4 == 0)
                    </div>
                    <div class="row">
                        <hr>
                        @endif
                        @empty

                        @endforelse

                    </div>
                    <div class="box-footer">
                    </div>
        </div>
    </div>

    {{--Modal do menu de ações--}}
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
                        <a class="btn btn-app">
                            <i class="fa fa-play"></i> Iniciar Sessão
                        </a>

                        <a class="btn btn-app">
                            <i class="fa fa-pause"></i> Finalizar Sessão
                        </a>

                        <a class="btn btn-app">
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

    {{-- Modal com os detalhes da ficha do jogador --}}
    <div class="modal fade" id="modal-details" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <div class="modal-title">
                        <h4 id="player_name">Jogador X </h4>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="tab-item active" id="tab_01_link">
                                <a href="#tab_1" data-toggle="tab">Informações</a>
                            </li>

                            <li class="tab-item">
                                <a href="#tab_2" data-toggle="tab">Atributos</a>
                            </li>

                            <li class="tab-item disabled" {!! $controlRpg ? 'style="display: block"' : 'style="display: none"' !!} id="inventory">
                                <a href="#tab_3" data-toggle="tab">Inventário</a>
                            </li>

                            <li class="tab-item disabled" {!! $controlRpg ? 'style="display: block"' : 'style="display: none"' !!} id="spells">
                                <a href="#tab_4" data-toggle="tab">Magias</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <p>
                                    <strong>Nome: </strong> <span id="char_name"></span>
                                </p>
                                <p>
                                    <strong>Raça: </strong> <span id="race"></span>
                                </p>
                                <p>
                                    <strong>Sub-Raça: </strong> <span id="sub_race"> </span>
                                </p>
                                <p>
                                    <strong>Classe: </strong> <span id="class"></span>
                                </p>
                                <p>
                                    <strong>Nível: </strong> <span id="level">00</span>
                                </p>
                                <p>
                                    <strong>Experiência: </strong> <span id="experience">00</span>
                                </p>
                                <p>
                                    <strong>Descrição: </strong> <span id="description"></span>
                                </p>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Atributo</th>
                                            <th>Valor</th>
                                            <th>Modificador</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Força</td>
                                            <td id="force_value">14</td>
                                            <td id="force_modify">+2</td>
                                        </tr>
                                        <tr>
                                            <td>Destreza</td>
                                            <td id="skill_value">14</td>
                                            <td id="skill_modify">+2</td>
                                        </tr>
                                        <tr>
                                            <td>Constituição</td>
                                            <td id="constitution_value">14</td>
                                            <td id="constitution_modify">+2</td>
                                        </tr>
                                        <tr>
                                            <td>Sabedoria</td>
                                            <td id="sapience_value">14</td>
                                            <td id="sapience_modify">+2</td>
                                        </tr>
                                        <tr>
                                            <td>Carisma</td>
                                            <td id="charisma_value">14</td>
                                            <td id="charisma_modify">+2</td>
                                        </tr>
                                        <tr>
                                            <td>Inteligência</td>
                                            <td id="intelligence_value">14</td>
                                            <td id="intelligence_modify">+2</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">

                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@section('js')
    <script>

        showCardDetails();

        function showCardDetails()
        {
            $('.btnShowDetails').on('click', function () {
                $.LoadingOverlay("show");
                let cardId      = $(this).data('cardid');
                let playerId    = $(this).data('player');

                loadCardData(cardId);

                let userId = '{!! auth()->user()->id !!}';

                let controlRpg = '{!! $controlRpg !!}';

                if(userId == playerId || controlRpg){
                    $('#inventory').css('display', 'block');
                    $('#spells').css('display', 'block');
                }else{
                    $('#inventory').css('display', 'none');
                    $('#spells').css('display', 'none');
                }

               // $('#modal-details').modal('show');
            });
        }

        function loadCardData(cardId)
        {
            let url = '{!! route('card.get.info', '_id') !!}'.replace('_id', cardId);
            let data = null;

            axios.get(url).then(function(response){
                data = response.data;
            }).then(function(){
                $('#player_name').text(data.player_name);
                $('#char_name').text(data.char_name);
                $('#race').text(data.race);
                $('#sub_race').text(data.sub_race ? data.sub_race : 'Não possui sub-raça');
                $('#class').text(data.class);
                $('#level').text(data.level);
                $('#experience').text(data.experience);
                $('#description').text(data.description);

                $('#force_value').text(data.attributes['force'].value);
                $('#force_modify').text( checkModifier(data.attributes['force'].modifier));

                $('#skill_value').text(data.attributes['skill'].value);
                $('#skill_modify').text(checkModifier(data.attributes['skill'].modifier));

                $('#constitution_value').text(data.attributes['constitution'].value);
                $('#constitution_modify').text(checkModifier(data.attributes['constitution'].modifier));

                $('#charisma_value').text(data.attributes['charisma'].value);
                $('#charisma_modify').text(checkModifier(data.attributes['charisma'].modifier));

                $('#sapience_value').text(data.attributes['sapience'].value);
                $('#sapience_modify').text(checkModifier(data.attributes['sapience'].modifier));

                $('#intelligence_value').text(data.attributes['intelligence'].value);
                $('#intelligence_modify').text(checkModifier(data.attributes['intelligence'].modifier));

            }).finally(function(){
                $.LoadingOverlay("hide");
                $('#modal-details').modal('show');
            });
        }

        function checkModifier(value)
        {
            value = value.toString();

            if(value.indexOf("-") == -1){
                return `+ ${value}`;
            }

            return value.replace('-', '- ');
        }

        $('#modal-details').on('hide.bs.modal', function(){
            $('.tab-item').removeClass('active');
            $('.tab-pane').removeClass('active');
            $('#tab_1').addClass('active');
            $('#tab_01_link').addClass('active');
        })
    </script>
@endsection