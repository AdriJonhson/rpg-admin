export default class Status{

    constructor()
    {
        this.init();
    }


    init()
    {
        this.listStatus();
        this.selectStatus();
        this.addStatus();
        this.addStatusToCard();
    }

    selectStatus()
    {
        $('#status-type').on('change', function(){
            let type = $(this).val();

            if(type === "Novo Status"){
                $('#status-damage').val('');
                $('#status-duration').val('');
                $('#status-name').val('');
                $('#status-active').prop('checked', false);
            }

            $('.status-info').slideDown();
        });
    }

    listStatus()
    {
        let table;
        $('#boardPanel').on('click', '.btnStatus',function(){

            let card_id = $(this).data('card');

            $('#btnAddStatusToCard').attr('data-card', card_id);

            let url = '/get-status/'+card_id;


            table = $('#status-table').DataTable({
                processing: true,
                bLengthChange: false,
                searching: false,
                bInfo: false,
                ajax: url,
                columns: [
                    {'data': 'id'},
                    {'data': 'id'},
                    {'data': 'id'},
                    {'data': 'id'},
                ],
                fnInitComplete: function(){
                    $('#modal-status').modal('show');
                }
            });

        });

        $('#modal-status').on('hide.bs.modal', function(){
            table.destroy();
        });
    }

    addStatus()
    {
        $('#btnAddStatus').on('click', function(){
            $('#modal-status').modal('hide');
            $('#modal-add-status').modal('show');
        });
    }

    addStatusToCard()
    {
        $('#btnAddStatusToCard').on('click', function(){

            let card = $(this).data('card');

            if( $('#status-name').val() === ''){
                warningToast('O Campo Nome é obrigatórios!');

            }else if($('#status-duration').val() === ''){
                warningToast('O Campo Duração é obrigatórios!');

            }else{
                let data = {
                    'name': $('#status-name').val(),
                    'duration': $('#status-duration').val(),
                    'active': $('#status-active').is(':checked') ? 1 : 0,
                    'hp'            : $('#status-hp').val(),
                    'mp'            : $('#status-mp').val(),
                    'skill'         : $('#status-skill').val(),
                    'force'         : $('#status-force').val(),
                    'constitution'  : $('#status-constitution').val(),
                    'sapience'      : $('#status-sapience').val(),
                    'charisma'      : $('#status-charisma').val(),
                    'intelligence'  : $('#status-intelligence').val(),
                };

                $('#modal-add-status').modal('hide');
                $.LoadingOverlay("show");

                $('#status-name').val('');
                $('#status-duration').val('');
                $('#status-active').prop('checked', false);
                $('#status-hp').val(0);
                $('#status-mp').val(0);
                $('#status-skill').val(0);
                $('#status-force').val(0);
                $('#status-constitution').val(0);
                $('#status-sapience').val(0);
                $('#status-charisma').val(0);
                $('#status-intelligence').val(0);

                axios.post(`/add-status/${card}`, data)
                    .then((response) => {
                    }).catch((ex) => {
                    errorToast(ex.response.data.message);
                }).finally(() => {
                    $.LoadingOverlay("hide");
                });
            }


        });

    }
}