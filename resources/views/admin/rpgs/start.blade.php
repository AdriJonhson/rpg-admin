@extends('adminlte::page')

@section('content_header')
    <h1>{!! $rpg->title !!}</h1>
@stop

@section('content')

    <div class="box">

        <div class="box-body">
            <div class="box-body">
               @for($i = 1; $i <= 5; $i ++)

                   @if($i == 1)
                       <div class="row">
                   @endif
                           <div class="col-sm-3">
                               <img class="profile-user-img img-responsive img-circle" src="https://i.imgur.com/dGo8DOk.png" alt="Player-Avatar">

                               <h3 class="profile-username text-center">Nina Mcintire</h3>

                               <p class="text-muted text-center">Software Engineer</p>

                               <ul class="list-group list-group-unbordered">
                                   <li class="list-group-item">
                                       <b>Followers</b> <a class="pull-right">1,322</a>
                                   </li>
                                   <li class="list-group-item">
                                       <b>Following</b> <a class="pull-right">543</a>
                                   </li>
                                   <li class="list-group-item">
                                       <b>Friends</b> <a class="pull-right">13,287</a>
                                   </li>
                               </ul>

                               <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                           </div>

                   @if($i % 4 == 0)
                       </div>
                       <div class="row">
                           <hr>
                   @endif


                @endfor
            </div>
        </div>

        <div class="box-footer">

        </div>
    </div>


@endsection