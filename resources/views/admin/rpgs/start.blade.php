@extends('adminlte::page')

@section('content_header')
    <h1>{!! $rpg->title !!}</h1>
@stop

@section('css')
    <style>
        .img-responsive
        {
            height: 100px;
        }
    </style>
@endsection

@section('content')

    <div class="box">

        <div class="box-body">
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
                                   <button type="button" class="btn btn-primary btn-flat {!! !$controlRpg ? 'btn-block' : '' !!}"><i class="fa fa-eye"></i> Detalhes</button>
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
        </div>

        <div class="box-footer">

        </div>
    </div>


@endsection