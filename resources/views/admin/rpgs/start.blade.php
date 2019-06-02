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

        .live{
            border-color: #41f450;
        }

        .die{
            border-color: #fc0800;
        }

        .negative{
            border-color: #ffb200;
        }

        .online {
            color: #00ff15;
        }

        .offline {
            color: #ff0000;
        }
    </style>
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{!! $rpg->title !!}</h3>
            <button class="pull-right btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-menu-actions"><i class="fa fa-th"></i> Menu de Ações</button>
        </div>

        <div class="box-body" id="boardPanel">
        </div>
    </div>

    {{--Modal do menu de ações--}}
    @include('admin.rpgs.modals.actions-menu')

    {{--Modal para editar as HP/MP/XP do jogador--}}
    @include('admin.rpgs.modals.edit-player')

    {{-- Modal com os detalhes da ficha do jogador --}}
    @include('admin.rpgs.modals.details')

    {{-- Modal para editar os status da ficha do jogador --}}
    @include('admin.rpgs.modals.status')
@endsection

@section('js')
    <script>
        let onlineUsers;
        let tableStatus;

        $(document).ready(function(){
            loadCards();
            joiningBoard();
            showCardDetails();
        });

        function showCardDetails()
        {
            $('#boardPanel').on('click', '.btnShowDetails', function () {
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

                let url = '/get-status/'+cardId;

                tableStatus = $('#status-table-details').DataTable({
                    processing: true,
                    bLengthChange: false,
                    searching: false,
                    bInfo: false,
                    ajax: url,
                    pageLength: 7,
                    columns: [
                        {'data': 'name'},
                        {render: function(data, type, row){return `${row.duration} Turnos`}},
                        {render: renderDetails},
                    ]
                });

                function renderDetails(data, type, row) {
                    return `<button type="button" class="btn btn-info btn-flat btn-status-details"
                                            data-status="${row.id}">
                                            <i class="fa fa-eye"></i></button>`;
                }



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

        function joiningBoard()
        {
            let rpg= JSON.parse('{!! request()->route('rpg')!!}');

            window.Echo.join(`Board.Rpg.${rpg.id}`).here((users)  => {
                onlineUsers = users;
                $(users).each(function(index, user){
                    $('#user-status-'+user.id).removeClass('offline');
                    $('#user-status-'+user.id).addClass('online');
                });
            })
            .joining((user) => {
                $('#user-status-'+user.id).removeClass('offline');
                $('#user-status-'+user.id).addClass('online');
            })
            .leaving((user) => {
                $('#user-status-'+user.id).removeClass('online');
                $('#user-status-'+user.id).addClass('offline');
            }).listen('CardUpdated', (e) => {
                loadCards(true, e);
                successToast(`A Ficha do: ${e.name} foi atualizada.`);
            }).listen('StatusEvents', (e) => {
                loadCards(true, e);
                infoToast(`O Status do: ${e.name} foram atualizados.`);
            });
        }

        function loadCards(reset = false, messageData = null)
        {
            $.LoadingOverlay("show");

            let rpg= JSON.parse('{!! request()->route('rpg')!!}');
            // let url = `/load-cards/${rpg.slug}`;
            let url = '{!! route('cards.load', '_rpg') !!}'.replace('_rpg', rpg.slug);
            let data = [];
            let injectHtml = '';

            axios.get(url).then(function(response){
                data = response.data;
                $(data.cards).each(function(key, value){
                    injectHtml = injectCard(value, key, injectHtml);
                });

                if(reset){
                    $('#boardPanel').empty();
                }

                $('#boardPanel').append(injectHtml);
            }).catch(function (ex) {
                console.log(ex);
            }).finally(function(){
                $.LoadingOverlay("hide");

                // if(reset){
                //     successToast(`A Ficha do: ${messageData.name} foi atualizada.`);
                // }
            });
        }

        $('#boardPanel').on('click', '.btnEditPlayer', function () {
            $.LoadingOverlay("show");
            let cardId      = $(this).data('cardid');

            $('#btnUpdateDataPlayer').data('cardid', cardId);

            let url = '{!! route('card.get.edit', '_id') !!}'.replace('_id', cardId);
            let data = null;

            axios.get(url).then(function(response){
                data = response.data.values;
            }).then(function(){
                $('#max_life_player').text(data.current_life+"/"+data.max_life);
                $('#max_mana_player').text(data.current_mana+"/"+data.max_mana);
            }).finally(function(){
                $.LoadingOverlay("hide");
                $('#modal-edit-player').modal('show');
            });
        });

        $('#btnUpdateDataPlayer').on('click', function () {
            let responseData;

            let cardId = $(this).data('cardid');

            let url = '{!! route('card.get.update', '_id') !!}'.replace('_id', cardId);

            let data = {
                'life': $('#life_player').val(),
                'mana': $('#mana_player').val(),
                'xp': $('#xp_adquired').val(),
            };

            $('#modal-edit-player').modal('hide');
            $.LoadingOverlay("show");

            axios.put(url, data).then(function(response){
                responseData = response.data;
            }).catch(function(ex){
                errorToast(ex.response.data.message);
            }).finally(function(){
                $.LoadingOverlay("hide");
                successToast(responseData.message);
            });

        });

        $('#modal-details').on('hide.bs.modal', function(){
            $('.tab-item').removeClass('active');
            $('.tab-pane').removeClass('active');
            $('#tab_1').addClass('active');
            $('#tab_01_link').addClass('active');
        });

        $('#modal-edit-player').on('hide.bs.modal', function(){
            $('#life_player').val('');
            $('#mana_player').val('');
            $('#xp_adquired').val('');
        });

        $('#modal-details').on('hide.bs.modal', function(){
            tableStatus.destroy();
        });

        function injectCard(card, index, injectHtml)
        {
            let avatar = card.avatar_url != null ? '{!! url('__url') !!}'.replace('__url',  card.avatar_url) : 'https://i.imgur.com/dGo8DOk.png';
            let user_id = '{!! auth()->user()->id !!}';
            let controlRpg = '{!! $controlRpg !!}';
            let showSubRace = card.sub_race != null ? card.sub_race + ' | ' : '';
            let classCircle = 'offline';

            if(onlineUsers != null){
                for(let i = 0; i < onlineUsers.length; i++){
                    if(onlineUsers[i].id == card.model_id){
                        classCircle = 'online';
                    }
                }
            }

            // console.log(online)
            let buttonsControl = controlRpg ? `<button type="button" class="btn bg-orange btn-flat btnEditPlayer"
                                            data-cardid="${card.id}"
                                            data-player="${card.model_id }">
                                            <i class="fa fa-pencil"></i> Editar</button>
                                    <button type="button" class="btn bg-maroon btn-flat btnStatus" data-card="${card.id}"><i class="fa fa-star"></i> Status</button>` : '';

            injectHtml += `${index === 0 ? `<div class='row'>` : ``}<div class="col-sm-4">
                            <img class="profile-user-img img-responsive img-circle ${card.status}"
                                 src="${avatar}"
                                 alt="Player-Avatar">
                            <p class="text-center"><i class="fa fa-circle ${classCircle}" id="user-status-${card.model_id}"></i></p>

                            <h3 class="profile-username text-center" ${user_id == card.model_id ? 'style="font-weight: bold"' : ''}>${card.name}</h3>

                            <p class="text-muted text-center">${card.race} | ${showSubRace} ${card.class}</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Nível</b> <a class="pull-right">${card.level}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pontos de Vida</b> <a class="pull-right">${card.current_life} / ${card.health_point}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pontos de Mana</b> <a class="pull-right">${card.current_mana} / ${card.mana_point}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Classe de Armadura</b> <a class="pull-right">${card.constitution}</a>
                                </li>
                            </ul>

                            <div class="${controlRpg ? 'btn-group' : ''}" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary btnShowDetails btn-flat ${!controlRpg ? 'btn-block' : ''}"
                                        data-cardid="${card.id}">
                                    <i class="fa fa-eye"></i> Detalhes</button>
                                ${buttonsControl}
                                </div></div>${(index + 1) % 3 === 0 ? `</div><div class='row'><hr>` : ``}`;

            return injectHtml;
        }
    </script>
@endsection