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
                    <h4 class="modal-title">Jogador X</h4>
                </div>
                <div class="modal-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Informações</a></li>

                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Atributos</a></li>

                            <li class="" {!! $controlRpg ? 'style="display: block"' : 'style="display: none"' !!} id="inventory">
                                <a href="#tab_3" data-toggle="tab" aria-expanded="true">Inventário</a></li>

                            <li class="" {!! $controlRpg ? 'style="display: block"' : 'style="display: none"' !!} id="spells">
                                <a href="#tab_3" data-toggle="tab" aria-expanded="true">Magias</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tab_1">
                                <b>How to use:</b>

                                <p>Exactly like the original bootstrap tabs except you should use
                                    the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                                A wonderful serenity has taken possession of my entire soul,
                                like these sweet mornings of spring which I enjoy with my whole heart.
                                I am alone, and feel the charm of existence in this spot,
                                which was created for the bliss of souls like mine. I am so happy,
                                my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                                that I neglect my talents. I should be incapable of drawing a single stroke
                                at the present moment; and yet I feel that I never was a greater artist than now.
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                The European languages are members of the same family. Their separate existence is a myth.
                                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                new common language would be desirable: one could refuse to pay expensive translators. To
                                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                words. If several languages coalesce, the grammar of the resulting language is more simple
                                and regular than that of the individual languages.
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                like Aldus PageMaker including versions of Lorem Ipsum.
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
                let cardId      = $(this).data('cardid');
                let playerId    = $(this).data('player');

                let userId = '{!! auth()->user()->id !!}';

                let controlRpg = '{!! $controlRpg !!}';

                if(userId == playerId || controlRpg){
                    $('#inventory').css('display', 'block');
                    $('#spells').css('display', 'block');
                }else{
                    $('#inventory').css('display', 'none');
                    $('#spells').css('display', 'none');
                }

               $('#modal-details').modal('show');
            });
        }

    </script>
@endsection