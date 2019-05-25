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
}