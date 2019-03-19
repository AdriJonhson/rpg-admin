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
                    <li><a href="#step-1">Criaçao do personagem<br /><small>Montando personagem</small></a></li>
                    <li><a href="#step-2">Atributos<br /><small>Atributos do personagem</small></a></li>
                    <li><a href="#step-3">Status<br /><small>Dados de status</small></a></li>
                    <li><a href="#step-4">Finalizar<br /><small>Dados Informados</small></a></li>
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

        $(document).ready(function(){
            $('#smartwizard').smartWizard({
                useURLhash: false,
                lang: {  // Language variables
                    next: 'Próximo',
                    previous: 'Anterior'
                },
                transitionEffect: 'fade',
            });

            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                if(stepNumber == 1){

                }

                if(stepNumber == 2){
                    alert('Dados de status');
                }

                if(stepNumber == 3){
                    alert('finalizar....');
                }
            });
        });

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

        function setAttributes(race) {

            let force           = parseInt($('#force').val());
            let skill           = parseInt($('#skill').val());
            let constitution    = parseInt($('#constitution').val());
            let sapience        = parseInt($('#sapience').val());
            let charisma        = parseInt($('#charisma').val());
            let intelligence    = parseInt($('#intelligence').val());

            if(race == "Anão"){

                $('#constitution').val(constitution + 2);

            }else if(race == "Elfo"){

            }else if(race == "Halfling"){

            }else if(race == "Gnomo"){

            }else if(race == "Draconato"){

                $('#force').val(force + 2);

            }else if(race == "Humano"){

                $('#force').val(force + 1);

            }else if(race == "Meio-Orc"){

                $('#force').val(force + 2);

            }



        }

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