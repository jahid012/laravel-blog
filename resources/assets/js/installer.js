$(document).ready(function(){

    var connection = $('#db_form [name="DB_CONNECTION"]').val();

    function isSqlite (connection){

        if(connection == 'sqlite'){
            $("#db_form input").each(function () {
                if($(this).attr('name') != '_token'){
                    $(this).parent().parent().addClass('hide');
                    $("#database_sqlite_path").parent().parent().removeClass('hide');
                }
            });
        }else{
            $("#db_form input").each(function () {
                if($(this).attr('name') != '_token'){
                    $(this).parent().parent().removeClass('hide');
                    $("#database_sqlite_path").parent().parent().addClass('hide');
                }
            });
        }

    }

    isSqlite(connection);

    $('#db_form [name="DB_CONNECTION"]').on('change', function(){
        isSqlite($(this).val());
    })




});
