export default class Status{

    constructor()
    {
        this.init();
    }


    init()
    {
        // $('#boardPanel').on('click', '.btnEditStatusPlayer',function(){
        //     $('#modal-edit-status').modal('show');
        // });

        $('.select2').select2();

        this.listStatus();
        this.selectStatus();
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
        $('#boardPanel').on('click', '.btnEditStatusPlayer',function(){
            $('#modal-status').modal('show');
        });
    }
}