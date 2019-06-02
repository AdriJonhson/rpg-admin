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
        this.removeStatusToCard();
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
                pageLength: 7,
                columns: [
                    {'data': 'name'},
                    {render: function(data, type, row){return `${row.duration} Turnos`}},
                    {render: renderDetails},
                    {render: renderRemove},
                ],
                fnInitComplete: function(){
                    $('#modal-status').modal('show');
                }
            });

            function renderDetails(data, type, row) {
                return `<button type="button" class="btn btn-info btn-flat btn-status-details">
                                            <i class="fa fa-eye"></i></button>`;
            }

            function renderRemove(data, type, row) {
                return `<button type="button" class="btn btn-danger btn-flat btn-status-remove"
                                                data-status=${row.id}
                                                data-card="${card_id}">
                                            <i class="fa fa-trash"></i></button>`;
            }

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

    removeStatusToCard()
    {
        $('#status-table').on('click', '.btn-status-remove', function(){

            let status_id = $(this).data('status');
            let card_id = $(this).data('card');

            let url = `/remove-status/${card_id}/status/${status_id}`;

            $('#modal-status').modal('hide');
            $.LoadingOverlay("show");

            axios.delete(url).catch((response) => {
                errorToast(ex.response.data.message);
            }).finally(() => {
                $.LoadingOverlay("hide");
            });
        });
    }
}