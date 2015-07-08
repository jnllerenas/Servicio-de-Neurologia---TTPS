$(document).ready(
    function(){

        $('form').submit(function(){
            $(":submit").hide();
                    $(":submit").after(
                            $('<button/>').attr('disabled','disabled')
                                .text('Procesando...')
                                .val('Procesando...')
                                .addClass('btn')
                                .addClass('btn-primary'));
        });
        
        $('a.btn-submit').click(function(){
            $(this).attr('disabled','disabled').text('Procesando...');
        });

    }
);