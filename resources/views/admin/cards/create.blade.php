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

        <div class="overlay" id="loading" hidden>
            <i class="fa fa-refresh fa-spin"></i>
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
            let subRace = $('#sub-race').val();

            setAttributesRace(race, subRace);
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
            $('#hp').val(life);
        }

        function setAttributesRace(race, subRace)
        {
            let calcForce           = 0;
            let calcSkill           = 0;
            let calcConstitution    = 0;
            let calcSapience        = 0;
            let calcCharisma        = 0;
            let calcIntelligence    = 0;

            let force = parseInt($('#force').val());
            let skill = parseInt($('#skill').val());
            let constitution = parseInt($('#constitution').val());
            let sapience = parseInt($('#sapience').val());
            let charisma = parseInt($('#charisma').val());
            let intelligence = parseInt($('#intelligence').val());

            if(race == "Humano"){
                // $('#force').val(force + 1);
                // $('#skill').val(skill + 1);
                // $('#constitution').val(constitution + 1);
                // $('#intelligence').val(intelligence + 1);
                // $('#sapience').val(sapience + 1);

                calcForce = force + 1;
                calcSkill = skill + 1;
                calcConstitution = constitution + 1;
                calcSapience = sapience + 1;
                calcCharisma = charisma + 1;
                calcIntelligence = intelligence + 1;

               // $('#charisma').val(charisma + 1);

            }else if(race == "Draconato"){
                // $('#force').val(force + 2);
                // $('#charisma').val(force + 1);

                calcForce = force + 1;
                calcCharisma = charisma + 1;

            }else if(race == "Meio-Orc"){
                // $('#force').val(force + 2);
                // $('#constitution').val(constitution + 1);

                calcForce = force + 2;
                calcConstitution = constitution + 1;

            }else if(race == "Elfo"){
                // $('#skill').val(skill + 2);

                calcSkill = skill + 2;
            }else if(race == "Halfling"){
                // $('#skill').val(skill + 2);

                calcSkill = skill + 2;
            }else if(race == "Anão"){
                // $('#constitution').val(constitution + 2);

                calcConstitution = constitution + 2;
            }else if(race == "Gnomo"){
                // $('#intelligence').val(intelligence + 2);

                calcIntelligence = intelligence + 2;
            }else if(race == "Tiefling"){
                // $('#intelligence').val(intelligence + 1);
                // $('#charisma').val(charisma + 2);

                calcIntelligence = intelligence + 1;
                calcCharisma = charisma + 2;

            }else if(race == "Meio-Elfo"){
                // $('#charisma').val(charisma + 2);
                calcCharisma = charisma + 2;
            }

            if(subRace != null){
                if(subRace == "Anão da Montanha"){
                    // $('#force').val(force + 2);
                    calcForce += 2;
                }else if(subRace == "Gnomo da Floresta"){
                    // $('#skill').val(skill + 2);
                    calcSkill +=  2;
                }else if(subRace == "Halfling Robusto"){
                    // $('#constitution').val(constitution + 1);
                    calcConstitution +=  1;
                }else if(subRace == "Gnomo Das Rochas"){
                    // $('#constitution').val(constitution + 1);
                    calcConstitution += 1;
                }else if(subRace == "Alto Elfo"){
                    // $('#intelligence').val(intelligence + 1);
                    calcIntelligence += 1;
                }else if(subRace == "Anão Da Colina"){
                    // $('#sapience').val(sapience + 1);
                    calcSapience += 1;
                }else if(subRace == "Elfo Da Floresta"){
                    // $('#sapience').val(sapience + 1);
                    calcSapience += 1;
                }else if(race == "Meio-Elfo"){
                    // $('#charisma').val(charisma + 2);
                    calcCharisma += 2;
                }else if(subRace == "Drow"){
                    // $('#charisma').val(charisma + 1);
                    calcCharisma += 1;
                }else if(subRace == "Pés-Leves"){
                    // $('#charisma').val(charisma + 1);
                    calcCharisma += 1;
                }
            }

            $('#char_force').text(setAttributoAndModify(calcForce == 0 ? force : calcForce));
            $('#char_skill').text(setAttributoAndModify(calcSkill == 0 ? skill : calcSkill));
            $('#char_constitution').text(setAttributoAndModify(calcConstitution == 0 ? constitution : calcConstitution));
            $('#char_sapience').text(setAttributoAndModify(calcSapience == 0 ? sapience : calcSapience));
            $('#char_charisma').text(setAttributoAndModify(calcCharisma == 0 ? charisma : calcCharisma));
            $('#char_intelligence').text(setAttributoAndModify(calcIntelligence == 0 ? intelligence : calcIntelligence));
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

            // $('#char_force').text(calcForce);
            // $('#char_skill').text(calcSkill);
            // $('#char_constitution').text(calcConstitution);
            // $('#char_sapience').text(calcSapience);
            // $('#char_charisma').text(calcCharisma);
            // $('#char_intelligence').text(calcIntelligence);
        }

        function setAttributoAndModify(value)
        {
            let text = '';
            if(value == 8 || value == 9){
                text = value + ' | -1';

            }else if(value == 10 || value == 11){
                text = value + ' | +0';

            }else if(value == 12 || value == 13){
                text = value + ' | +1'

            }else if(value == 14 || value == 15){
                text = value + ' | +2'

            }else if(value == 16 || value == 17){
                text = value + ' | +3'

            }else if(value == 18 || value == 19){
                text = value + ' | +4'

            }else if(value == 20 || value == 21){
                text = value + ' | +5'

            }else if(value == 22 || value == 23){
                text = value + ' | +6'

            }else if(value == 24 || value == 25){
                text = value + ' | +7'

            }else if(value == 26 || value == 27){
                text = value + ' | +8'

            }else if(value == 28 || value == 29){
                text = value + ' | +9'

            }else if(value == 30){
                text = value + ' | +10'
            }

            return text;
        }

        $('#perfil').on('change', function(){
            readURL(this);
        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploadImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#btnFinish').on('click', function (e) {
            e.preventDefault();
            //active loading
            $('#loading').show();

            let urlSubmitCard = "{!! route('card.store', $rpg->id) !!}";

            //Personal data
            let name = $('#name').val();
            let race = $('#race').val();
            let sub_race = $('#sub-race').val();
            let classPlayer = $('#class').val();
            let personalidade = $('#personalidade').val();

            //attributes
            let force = parseInt($('#force').val());
            let skill = parseInt($('#skill').val());
            let constitution = parseInt($('#constitution').val());
            let sapience = parseInt($('#sapience').val());
            let charisma = parseInt($('#charisma').val());
            let intelligence = parseInt($('#intelligence').val());

            //status
            let mp = $('#mp').val();
            let ca = $('#ca').val();
            let hp = $('#hp').val();

            let formData = new FormData;

            formData.append('name', name);
            formData.append('race', race);
            formData.append('sub_race', sub_race);
            formData.append('class', classPlayer);
            formData.append('personalidade', personalidade);
            formData.append('force', force);
            formData.append('skill', skill);
            formData.append('constitution', constitution);
            formData.append('sapience', sapience);
            formData.append('charisma', charisma);
            formData.append('intelligence', intelligence);
            formData.append('mp', mp);
            formData.append('ca', ca);
            formData.append('hp', hp);

            formData.append("perfil", document.getElementById('perfil').files[0]);

            axios.post(urlSubmitCard, formData).then(response => {
                let urlGo = "{!! route('rpg.start', $rpg->slug) !!}";
                window.location.href = urlGo;
            }).catch(error => {
                let urlBack = "{!! route('rpg.index') !!}";
                window.location.href = urlBack;
            });
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);

            if(stepDirection === 'forward' && elmForm){
                elmForm.validator('validate');
                var elmErr = elmForm.children('.has-error');
                if(elmErr && elmErr.length > 0){
                    // Form validation failed
                    return false;
                }
            }
            return true;
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
    </style>
@endsection