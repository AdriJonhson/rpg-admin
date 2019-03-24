@extends('adminlte::page')

@section('content')

    <div class="box">
        <div class="box-header">
            <h4 class="box-title">
                Ficha
            </h4>
        </div>
        <div class="box-body">
            <div id="smartwizard" class="sw-main sw-theme-arrows">
                <ul>
                    <li><a href="#step-1">Criaçao do personagem<br/>
                            <small>Montando personagem</small>
                        </a></li>
                    <li><a href="#step-2">Atributos<br/>
                            <small>Atributos do personagem</small>
                        </a></li>
                    <li><a href="#step-3">Status<br/>
                            <small>Dados de status</small>
                        </a></li>
                    <li><a href="#step-4">Finalizar<br/>
                            <small>Dados Informados</small>
                        </a></li>
                </ul>

                <div>
                    <div id="step-1" class="">
                        @include('admin.cards.wizard.personal-data')
                    </div>
                    <div id="step-2" class="">
                        @include('admin.cards.wizard.attributes')
                    </div>
                    <div id="step-3" class="">
                        @include('admin.cards.wizard.status')
                    </div>
                    <div id="step-4" class="">
                        @include('admin.cards.wizard.finish')
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script>
        $('.dropify').dropify();

        $(document).ready(function () {
            $('#smartwizard').smartWizard({
                useURLhash: false,
                lang: {  // Language variables
                    next: 'Próximo',
                    previous: 'Anterior'
                },
                transitionEffect: 'fade',
            });

            $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
                if (stepNumber == 1) {

                }

                if (stepNumber == 2) {
                    //alert('Dados de status');
                }

                if (stepNumber == 3) {
                    finishCard();
                }
            });
        });

        //JS que vai setar as sub-raças dependendo da raça selecionada
        $('#race').on('change', function () {
            let race = $(this).val();

            let sub_races = $('#sub-race');

            sub_races.prop('disabled', false);
            sub_races.empty();

            if (race == "Anão") {
                sub_races.append("<option value='Anão Da Montanha'>Anão Da Montanha</option>");
                sub_races.append("<option value='Anão Da Colina'>Anão Da Colina</option>");
            } else if (race == "Elfo") {
                sub_races.append("<option value='Alto Elfo'>Alto Elfo</option>");
                sub_races.append("<option value='Elfo da Floresta'>Elfo da Floresta</option>");
                sub_races.append("<option value='Drow'>Drow</option>");
            } else if (race == "Halfling") {
                sub_races.append("<option value='Pés-Leves'>Pés-Leves</option>");
                sub_races.append("<option value='Robusto'>Robusto</option>");
            } else if (race == "Gnomo") {
                sub_races.append("<option value='Gnomo Das Rochas'>Gnomo Das Rochas</option>");
                sub_races.append("<option value='Gnomo Da Floresta'>Gnomo Da Floresta</option>");
            } else {
                sub_races.prop('disabled', true);
                sub_races.append("<option value='Gnomo Das Rochas' disabled selected>Essa raça nao possui nenhuma sub-raça</option>");
            }
        });

        //JS que vai remover o valor do atributo selecionado dos outros selects
        $('.atrributes').on('change', function () {
            let value = parseInt($(this).val());
            let modify = 0;

            $(this).prop('disabled', true);

            $(".atrributes option[value=" + value + "]").remove();

            $(this).append("<option value="+value+" selected>"+value+"</option>");

            if(value === 8){
                modify = "-1"
            }else if(value === 10){
                modify = "+0"
            }else if(value === 12 || value === 13){
                modify = "+1"
            }else if(value === 14 || value === 15){
                modify = "+2"
            }

            $(this).closest('div').find('.input-group-addon').text(modify)
        });

        //JS para resetar os atributos
        $('.btn-reset').on('click', function () {
            $('.atrributes').empty();
            $('.atrributes').append('<option value="">Selecione o valor do atributo</option>');
            $('.atrributes').append("<option value=\"8\">8</option>");
            $('.atrributes').append("<option value=\"10\">10</option>");
            $('.atrributes').append("<option value=\"12\">12</option>");
            $('.atrributes').append("<option value=\"13\">13</option>");
            $('.atrributes').append("<option value=\"14\">14</option>");
            $('.atrributes').append("<option value=\"15\">15</option>");
            $('.atrributes').prop('disabled', false);

            $('.atrributes').each(function(index, key){
                $(this).closest('div').find('.input-group-addon').text(0)
            })
        });

        function finishCard()
        {
            let race = $('#race').val();
            let subRace = $('#sub_race').val();

            setAttributesRace(race);
            setAttributesSubrace(subRace);
            mountCard();
            calculateLife();
        }

        function calculateLife()
        {
            let classPlayer = $('#class').val();
            let ca = $('#ca').val();
            let life = 0;

            if(classPlayer == "Bardo" || classPlayer == "Clérigo"
                || classPlayer == "Bruxo" || classPlayer == "Druida" || classPlayer == "Ladino"
                || classPlayer == "Monge"){
                life = 8;
            }else if(classPlayer == "Bárbaro"){
                life = 12;
            }else if(classPlayer == "Feiticeiro" || classPlayer == "Mago"){
                life = 6;
            }else if(classPlayer == "Guerreiro" || classPlayer == "Paladino"
                || classPlayer == "Patrulheiro"){
                life = 10;
            }

            life += parseInt(ca);

            $('#char_hp').text(life+'/'+life);
        }

        function setAttributesRace(race)
        {
            let force = parseInt($('#force').val());
            let skill = parseInt($('#skill').val());
            let constitution = parseInt($('#constitution').val());
            let sapience = parseInt($('#sapience').val());
            let charisma = parseInt($('#charisma').val());
            let intelligence = parseInt($('#intelligence').val());

            if(race == "Humano"){
                $('#force').val(force + 1);
                $('#skill').val(skill + 1);
                $('#constitution').val(constitution + 1);
                $('#intelligence').val(intelligence + 1);
                $('#sapience').val(sapience + 1);
               // $('#charisma').val(charisma + 1);

                let test = $('#charisma').val();

                console.log(test);
            }else if(race == "Draconato"){
                $('#force').val(force + 2);
                $('#charisma').val(force + 1);
            }else if(race == "Meio-Orc"){
                $('#force').val(force + 2);
                $('#constitution').val(constitution + 1);
            }else if(race == "Elfo"){
                $('#skill').val(skill + 2);
            }else if(race == "Halfling"){
                $('#skill').val(skill + 2);
            }else if(race == "Anão"){
                $('#constitution').val(constitution + 2);
            }else if(race == "Gnomo"){
                $('#intelligence').val(intelligence + 2);
            }else if(race == "Tiefling"){
                $('#intelligence').val(intelligence + 1);
                $('#charisma').val(charisma + 2);
            }else if(race == "Meio-Elfo"){
                $('#charisma').val(charisma + 2);
            }
        }

        function setAttributesSubrace(subRace)
        {

            let force = parseInt($('#force').val());
            let skill = parseInt($('#skill').val());
            let constitution = parseInt($('#constitution').val());
            let sapience = parseInt($('#sapience').val());
            let charisma = parseInt($('#charisma').val());
            let intelligence = parseInt($('#intelligence').val());

            if(subRace == "Anão da Montanha"){
                $('#force').val(force + 2);
            }else if(subRace == "Gnomo da Floresta"){
                $('#skill').val(skill + 2);
            }else if(subRace == "Halfling Robusto"){
                $('#constitution').val(constitution + 1);
            }else if(subRace == "Gnomo Das Rochas"){
                $('#constitution').val(constitution + 1);
            }else if(subRace == "Alto Elfo"){
                $('#intelligence').val(intelligence + 1);
            }else if(subRace == "Anão Da Colina"){
                $('#sapience').val(sapience + 1);
            }else if(subRace == "Elfo Da Floresta"){
                $('#sapience').val(sapience + 1);
            }else if(race == "Meio-Elfo"){
                $('#charisma').val(charisma + 2);
            }else if(subRace == "Drow"){
                $('#charisma').val(charisma + 1);
            }else if(subRace == "Pés-Leves"){
                $('#charisma').val(charisma + 1);
            }
        }

        function mountCard()
        {
            let mp = $('#mp').val();
            let name = $('#name').val();
            let race = $('#race').val();
            let subRace = $('#sub-race').val();
            let clasPlayer = $('#class').val();
            let ca = $('#ca').val();

            let textRace = '';

            if(subRace == null){
                textRace = race + ' | ' + clasPlayer;
            }else{
                textRace = race + ' | ' + subRace + ' | ' + clasPlayer;
            }

            $('#char_name').text(name);
            $('#char_class_race').text(textRace);
            $('#char_mp').text(mp+'/'+mp);
            $('#char_ca').text(ca);

            let force = parseInt($('#force').val());
            let skill = parseInt($('#skill').val());
            let constitution = parseInt($('#constitution').val());
            let sapience = parseInt($('#sapience').val());
            let charisma = parseInt($('#charisma').val());
            let intelligence = parseInt($('#intelligence').val());

            $('#char_force').text(force);
            $('#char_skill').text(skill);
            $('#char_constitution').text(constitution);
            $('#char_sapience').text(sapience);
            $('#char_charisma').text(charisma);
            $('#char_intelligence').text(intelligence);
        }

        // $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
        //     var elmForm = $("#form-step-" + stepNumber);
        //
        //     if(stepDirection === 'forward' && elmForm){
        //         elmForm.validator('validate');
        //         var elmErr = elmForm.children('.has-error');
        //         if(elmErr && elmErr.length > 0){
        //             // Form validation failed
        //             return false;
        //         }
        //     }
        //     return true;
        // });
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
    </style>
@endsection